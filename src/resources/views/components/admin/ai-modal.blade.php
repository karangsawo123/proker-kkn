@if(config('ai.enabled'))
<div class="ai-modal-backdrop" id="aiModalBackdrop" style="display: none;" aria-hidden="true">
    <div class="ai-modal-dialog" role="dialog" aria-labelledby="aiModalTitle" aria-modal="true">
        <div class="ai-modal-header">
            <div class="ai-modal-header-brand">
                <span class="ai-sparkle-badge" aria-hidden="true">✨</span>
                <div>
                    <h3 class="ai-modal-title" id="aiModalTitle">Asisten Penulisan AI</h3>
                    <p class="ai-modal-subtitle" id="aiModalSubtitle">Bantu buat dan sempurnakan draf teks secara instan</p>
                </div>
            </div>
            <button type="button" class="ai-modal-close" id="aiModalCloseBtn" aria-label="Tutup Dialog">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="ai-modal-body">
            <!-- Mode Selector Tabs -->
            <div class="ai-mode-pills" role="tablist" aria-label="Pilihan Mode AI">
                <button type="button" class="ai-mode-pill is-active" data-mode="draft">Buat Draf Baru</button>
                <button type="button" class="ai-mode-pill" data-mode="rapikan">Rapikan Ejaan</button>
                <button type="button" class="ai-mode-pill" data-mode="formal">Lebih Formal</button>
                <button type="button" class="ai-mode-pill" data-mode="persingkat">Persingkat</button>
            </div>

            <!-- Notice / Boundary Information -->
            <div class="ai-safety-notice">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                <span>AI hanya menyusun draf dari catatan Anda. Tanggal, lokasi, dan status tetap diatur manual.</span>
            </div>

            <!-- Input Fields -->
            <div class="ai-input-section" id="aiInputSection">
                <div class="form-group" id="aiNotesGroup">
                    <label for="aiNotesInput" class="form-label">Catatan / Poin Fakta Mentah <span class="required-mark">*</span></label>
                    <textarea 
                        id="aiNotesInput" 
                        class="form-textarea" 
                        rows="4" 
                        placeholder="Contoh: Posyandu balita selasa depan balai dusun jam 9 pagi, ada penimbangan dan imunisasi..."
                        maxlength="2500"
                    ></textarea>
                    <span class="field-hint">Tuliskan poin-poin yang ingin disampaikan. AI akan merapikannya menjadi kalimat resmi.</span>
                </div>

                <div class="form-group" id="aiExistingTextGroup" style="display: none;">
                    <label for="aiExistingTextInput" class="form-label">Teks Yang Ingin Disempurnakan</label>
                    <textarea 
                        id="aiExistingTextInput" 
                        class="form-textarea" 
                        rows="4" 
                        placeholder="Teks dari form yang ingin dirapikan atau diubah gaya bahasanya..."
                        maxlength="4500"
                    ></textarea>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div class="ai-loading-state" id="aiLoadingState" style="display: none;">
                <div class="ai-spinner"></div>
                <p>Sedang menyusun draf dengan AI...</p>
                <small>Mohon tunggu beberapa detik</small>
            </div>

            <!-- Error Box -->
            <div class="ai-error-box" id="aiErrorBox" style="display: none;" role="alert">
                <p id="aiErrorMessage">Layanan bantuan AI sedang tidak tersedia.</p>
            </div>

            <!-- Result / Preview Section -->
            <div class="ai-result-section" id="aiResultSection" style="display: none;">
                <div class="ai-result-header">
                    <span class="ai-result-badge">Pratinjau Hasil Draf AI</span>
                </div>
                
                <div class="form-group" id="aiResultTitleGroup" style="display: none;">
                    <label class="form-label text-sm">Usulan Judul:</label>
                    <div class="ai-preview-box" id="aiPreviewTitle"></div>
                </div>

                <div class="form-group" id="aiResultTextGroup">
                    <label class="form-label text-sm">Usulan Teks:</label>
                    <div class="ai-preview-box ai-preview-content" id="aiPreviewContent"></div>
                </div>
            </div>
        </div>

        <div class="ai-modal-footer">
            <div class="ai-footer-left">
                <button type="button" class="btn btn-secondary" id="aiCancelBtn">Batal</button>
            </div>
            <div class="ai-footer-right">
                <button type="button" class="btn btn-secondary" id="aiRetryBtn" style="display: none;">Buat Ulang</button>
                <button type="button" class="btn btn-primary" id="aiGenerateBtn">
                    <span>✨ Generate Draf</span>
                </button>
                <button type="button" class="btn btn-primary btn-apply" id="aiApplyBtn" style="display: none;">
                    <span>✓ Terapkan ke Form</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
