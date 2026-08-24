/**
 * AI Writing Assistant Frontend Client (Vanilla JS)
 * Non-blocking, Human-in-the-loop draft generator.
 */

document.addEventListener('DOMContentLoaded', () => {
    const modalBackdrop = document.getElementById('aiModalBackdrop');
    if (!modalBackdrop) return;

    const closeBtn = document.getElementById('aiModalCloseBtn');
    const cancelBtn = document.getElementById('aiCancelBtn');
    const generateBtn = document.getElementById('aiGenerateBtn');
    const applyBtn = document.getElementById('aiApplyBtn');
    const retryBtn = document.getElementById('aiRetryBtn');

    const inputSection = document.getElementById('aiInputSection');
    const notesGroup = document.getElementById('aiNotesGroup');
    const existingTextGroup = document.getElementById('aiExistingTextGroup');
    const notesInput = document.getElementById('aiNotesInput');
    const existingTextInput = document.getElementById('aiExistingTextInput');

    const loadingState = document.getElementById('aiLoadingState');
    const errorBox = document.getElementById('aiErrorBox');
    const errorMessage = document.getElementById('aiErrorMessage');

    const resultSection = document.getElementById('aiResultSection');
    const resultTitleGroup = document.getElementById('aiResultTitleGroup');
    const previewTitle = document.getElementById('aiPreviewTitle');
    const previewContent = document.getElementById('aiPreviewContent');

    const modePills = document.querySelectorAll('.ai-mode-pill');

    let currentFeature = 'pengumuman_draft';
    let currentMode = 'draft';
    let targetTitleElement = null;
    let targetTextElement = null;
    let generatedData = null;

    // Open Modal from Trigger Buttons
    document.querySelectorAll('.btn-ai-assist').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            currentFeature = btn.dataset.aiFeature || 'pengumuman_draft';
            const titleId = btn.dataset.targetTitle;
            const textId = btn.dataset.targetText;

            targetTitleElement = titleId ? document.getElementById(titleId) : null;
            targetTextElement = textId ? document.getElementById(textId) : null;

            const existingVal = targetTextElement ? targetTextElement.value : '';
            existingTextInput.value = existingVal;

            if (existingVal.trim().length > 0) {
                // If there is existing text, allow rapikan/formal/persingkat easily
                existingTextGroup.style.display = 'block';
            } else {
                existingTextGroup.style.display = 'none';
            }

            resetModalState();
            modalBackdrop.style.display = 'flex';
            modalBackdrop.setAttribute('aria-hidden', 'false');
            notesInput.focus();
        });
    });

    // Close Modal
    function closeModal() {
        modalBackdrop.style.display = 'none';
        modalBackdrop.setAttribute('aria-hidden', 'true');
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    modalBackdrop.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            closeModal();
        }
    });

    // Mode Pill Switching
    modePills.forEach(pill => {
        pill.addEventListener('click', () => {
            modePills.forEach(p => p.classList.remove('is-active'));
            pill.classList.add('is-active');
            currentMode = pill.dataset.mode;

            if (currentMode === 'draft') {
                notesGroup.style.display = 'block';
                if (!existingTextInput.value.trim()) {
                    existingTextGroup.style.display = 'none';
                } else {
                    existingTextGroup.style.display = 'block';
                }
            } else {
                existingTextGroup.style.display = 'block';
                notesGroup.style.display = 'block';
            }
        });
    });

    function resetModalState() {
        generatedData = null;
        inputSection.style.display = 'block';
        loadingState.style.display = 'none';
        errorBox.style.display = 'none';
        resultSection.style.display = 'none';
        generateBtn.style.display = 'inline-flex';
        generateBtn.disabled = false;
        applyBtn.style.display = 'none';
        retryBtn.style.display = 'none';
    }

    // Generate Request
    async function requestAiDraft() {
        const notes = notesInput.value.trim();
        const existingText = existingTextInput.value.trim();

        if (!notes && !existingText) {
            errorBox.style.display = 'block';
            errorMessage.textContent = 'Silakan isi catatan fakta atau teks yang ingin disempurnakan.';
            return;
        }

        inputSection.style.display = 'none';
        resultSection.style.display = 'none';
        errorBox.style.display = 'none';
        loadingState.style.display = 'block';
        generateBtn.disabled = true;

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
                })
            });

            const result = await response.json();

            loadingState.style.display = 'none';

            if (!response.ok || !result.success) {
                inputSection.style.display = 'block';
                errorBox.style.display = 'block';
                errorMessage.textContent = result.message || 'Layanan bantuan AI sedang tidak tersedia.';
                generateBtn.disabled = false;
                return;
            }

            generatedData = result.data;
            renderResult(result.data);

        } catch (err) {
            loadingState.style.display = 'none';
            inputSection.style.display = 'block';
            errorBox.style.display = 'block';
            errorMessage.textContent = 'Gagal terhubung dengan server. Silakan isi form secara manual.';
            generateBtn.disabled = false;
        }
    }

    if (generateBtn) generateBtn.addEventListener('click', requestAiDraft);
    if (retryBtn) retryBtn.addEventListener('click', () => {
        resetModalState();
    });

    // Render Preview
    function renderResult(data) {
        resultSection.style.display = 'block';
        generateBtn.style.display = 'none';
        applyBtn.style.display = 'inline-flex';
        retryBtn.style.display = 'inline-flex';

        if (data.judul && targetTitleElement) {
            resultTitleGroup.style.display = 'block';
            previewTitle.textContent = data.judul;
        } else {
            resultTitleGroup.style.display = 'none';
        }

        const textOutput = data.isi || data.deskripsi || data.teks_hasil || '';
        previewContent.textContent = textOutput;
    }

    // Apply to Form
    if (applyBtn) {
        applyBtn.addEventListener('click', () => {
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
        });
    }
});
