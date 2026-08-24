/**
 * AI Writing Assistant Frontend Client (Vanilla JS)
 * Non-blocking, Human-in-the-loop draft generator.
 */

export function initAiAssistant() {
    let currentFeature = 'pengumuman_draft';
    let currentMode = 'draft';
    let targetTitleElement = null;
    let targetTextElement = null;
    let generatedData = null;

    function getModalElements() {
        const modalBackdrop = document.getElementById('aiModalBackdrop');
        if (!modalBackdrop) return null;

        return {
            modalBackdrop,
            closeBtn: document.getElementById('aiModalCloseBtn'),
            cancelBtn: document.getElementById('aiCancelBtn'),
            generateBtn: document.getElementById('aiGenerateBtn'),
            applyBtn: document.getElementById('aiApplyBtn'),
            retryBtn: document.getElementById('aiRetryBtn'),
            inputSection: document.getElementById('aiInputSection'),
            notesGroup: document.getElementById('aiNotesGroup'),
            existingTextGroup: document.getElementById('aiExistingTextGroup'),
            notesInput: document.getElementById('aiNotesInput'),
            existingTextInput: document.getElementById('aiExistingTextInput'),
            loadingState: document.getElementById('aiLoadingState'),
            errorBox: document.getElementById('aiErrorBox'),
            errorMessage: document.getElementById('aiErrorMessage'),
            resultSection: document.getElementById('aiResultSection'),
            resultTitleGroup: document.getElementById('aiResultTitleGroup'),
            previewTitle: document.getElementById('aiPreviewTitle'),
            previewContent: document.getElementById('aiPreviewContent'),
            modePills: document.querySelectorAll('.ai-mode-pill'),
        };
    }

    function resetModal(elements) {
        generatedData = null;
        if (elements.inputSection) elements.inputSection.style.display = 'block';
        if (elements.loadingState) elements.loadingState.style.display = 'none';
        if (elements.errorBox) elements.errorBox.style.display = 'none';
        if (elements.resultSection) elements.resultSection.style.display = 'none';
        if (elements.generateBtn) {
            elements.generateBtn.style.display = 'inline-flex';
            elements.generateBtn.disabled = false;
        }
        if (elements.applyBtn) elements.applyBtn.style.display = 'none';
        if (elements.retryBtn) elements.retryBtn.style.display = 'none';
    }

    function closeModal() {
        const elements = getModalElements();
        if (elements?.modalBackdrop) {
            elements.modalBackdrop.style.display = 'none';
            elements.modalBackdrop.setAttribute('aria-hidden', 'true');
        }
    }

    function openModal(triggerBtn) {
        const elements = getModalElements();
        if (!elements) {
            console.error('[AI Assistant] Modal element #aiModalBackdrop not found in DOM.');
            return;
        }

        currentFeature = triggerBtn.dataset.aiFeature || 'pengumuman_draft';
        const titleId = triggerBtn.dataset.targetTitle;
        const textId = triggerBtn.dataset.targetText;

        targetTitleElement = titleId ? document.getElementById(titleId) : null;
        targetTextElement = textId ? document.getElementById(textId) : null;

        const existingVal = targetTextElement ? targetTextElement.value : '';
        if (elements.existingTextInput) {
            elements.existingTextInput.value = existingVal;
        }

        if (elements.existingTextGroup) {
            elements.existingTextGroup.style.display = existingVal.trim().length > 0 ? 'block' : 'none';
        }

        resetModal(elements);
        elements.modalBackdrop.style.display = 'flex';
        elements.modalBackdrop.setAttribute('aria-hidden', 'false');

        if (elements.notesInput) {
            setTimeout(() => elements.notesInput.focus(), 50);
        }
    }

    // Global Document Click Delegation for Trigger Buttons
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('.btn-ai-assist');
        if (trigger) {
            e.preventDefault();
            e.stopPropagation();
            openModal(trigger);
            return;
        }

        const closeTrigger = e.target.closest('#aiModalCloseBtn, #aiCancelBtn');
        if (closeTrigger) {
            e.preventDefault();
            closeModal();
            return;
        }

        const modalBackdrop = document.getElementById('aiModalBackdrop');
        if (modalBackdrop && e.target === modalBackdrop) {
            closeModal();
            return;
        }

        const pill = e.target.closest('.ai-mode-pill');
        if (pill) {
            e.preventDefault();
            const elements = getModalElements();
            if (!elements) return;

            elements.modePills.forEach(p => p.classList.remove('is-active'));
            pill.classList.add('is-active');
            currentMode = pill.dataset.mode || 'draft';

            if (currentMode === 'draft') {
                if (elements.notesGroup) elements.notesGroup.style.display = 'block';
                if (elements.existingTextGroup) {
                    elements.existingTextGroup.style.display = elements.existingTextInput?.value.trim() ? 'block' : 'none';
                }
            } else {
                if (elements.existingTextGroup) elements.existingTextGroup.style.display = 'block';
                if (elements.notesGroup) elements.notesGroup.style.display = 'block';
            }
            return;
        }

        const generateBtn = e.target.closest('#aiGenerateBtn');
        if (generateBtn) {
            e.preventDefault();
            handleGenerate();
            return;
        }

        const retryBtn = e.target.closest('#aiRetryBtn');
        if (retryBtn) {
            e.preventDefault();
            const elements = getModalElements();
            if (elements) resetModal(elements);
            return;
        }

        const applyBtn = e.target.closest('#aiApplyBtn');
        if (applyBtn) {
            e.preventDefault();
            handleApply();
            return;
        }
    });

    async function handleGenerate() {
        const elements = getModalElements();
        if (!elements) return;

        const notes = elements.notesInput?.value.trim() || '';
        const existingText = elements.existingTextInput?.value.trim() || '';

        if (!notes && !existingText) {
            if (elements.errorBox && elements.errorMessage) {
                elements.errorBox.style.display = 'block';
                elements.errorMessage.textContent = 'Silakan isi catatan fakta atau teks yang ingin disempurnakan.';
            }
            return;
        }

        if (elements.inputSection) elements.inputSection.style.display = 'none';
        if (elements.resultSection) elements.resultSection.style.display = 'none';
        if (elements.errorBox) elements.errorBox.style.display = 'none';
        if (elements.loadingState) elements.loadingState.style.display = 'block';
        if (elements.generateBtn) elements.generateBtn.disabled = true;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const response = await fetch('/admin/ai/generate-draft', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                },
                body: JSON.stringify({
                    feature: currentFeature,
                    mode: currentMode,
                    notes: notes || null,
                    existing_text: existingText || null,
                }),
            });

            const result = await response.json();

            if (elements.loadingState) elements.loadingState.style.display = 'none';

            if (!response.ok || !result.success) {
                if (elements.inputSection) elements.inputSection.style.display = 'block';
                if (elements.errorBox && elements.errorMessage) {
                    elements.errorBox.style.display = 'block';
                    elements.errorMessage.textContent = result.message || 'Layanan bantuan AI sedang tidak tersedia.';
                }
                if (elements.generateBtn) elements.generateBtn.disabled = false;
                return;
            }

            generatedData = result.data;
            renderPreview(elements, result.data);

        } catch (err) {
            if (elements.loadingState) elements.loadingState.style.display = 'none';
            if (elements.inputSection) elements.inputSection.style.display = 'block';
            if (elements.errorBox && elements.errorMessage) {
                elements.errorBox.style.display = 'block';
                elements.errorMessage.textContent = 'Gagal terhubung dengan server. Silakan isi form secara manual.';
            }
            if (elements.generateBtn) elements.generateBtn.disabled = false;
        }
    }

    function renderPreview(elements, data) {
        if (elements.resultSection) elements.resultSection.style.display = 'block';
        if (elements.generateBtn) elements.generateBtn.style.display = 'none';
        if (elements.applyBtn) elements.applyBtn.style.display = 'inline-flex';
        if (elements.retryBtn) elements.retryBtn.style.display = 'inline-flex';

        if (data.judul && targetTitleElement && elements.previewTitle && elements.resultTitleGroup) {
            elements.resultTitleGroup.style.display = 'block';
            elements.previewTitle.textContent = data.judul;
        } else if (elements.resultTitleGroup) {
            elements.resultTitleGroup.style.display = 'none';
        }

        const textOutput = data.isi || data.deskripsi || data.teks_hasil || '';
        if (elements.previewContent) {
            elements.previewContent.textContent = textOutput;
        }
    }

    function handleApply() {
        if (!generatedData) return;

        if (generatedData.judul && targetTitleElement) {
            targetTitleElement.value = generatedData.judul;
            targetTitleElement.classList.add('ai-updated-flash');
            setTimeout(() => targetTitleElement.classList.remove('ai-updated-flash'), 1200);
        }

        const textOutput = generatedData.isi || generatedData.deskripsi || generatedData.teks_hasil || '';
        if (textOutput && targetTextElement) {
            targetTextElement.value = textOutput;
            targetTextElement.classList.add('ai-updated-flash');
            setTimeout(() => targetTextElement.classList.remove('ai-updated-flash'), 1200);
        }

        closeModal();
    }
}

// Auto-run if DOM ready or on DOMContentLoaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAiAssistant);
} else {
    initAiAssistant();
}
