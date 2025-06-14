<style>
    .cookie-consent {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(33, 37, 41, 0.95);
    color: #fff;
    padding: 1rem;
    z-index: 9999;
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
}

    .cookie-consent.show {
    transform: translateY(0);
}

.cookie-consent.hiding {
    transform: translateY(100%);
}

.cookie-settings {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}

.cookie-settings.show {
    max-height: 300px;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>

<div class="cookie-consent" id="cookieConsent">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h5>Consentimento de cookies</h5>
                <p class="mb-3">
                    Nós utilizamos os cookies para gerar dados estatísticos e garantir que você tenha a melhor experiência. Clicando "Ok, obrigado", você consente sobre o uso.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-primary me-2 mb-2" onclick="acceptAll()">Ok, obrigado</button>
                <button class="btn btn-outline-light me-2 mb-2" onclick="toggleSettings()">Detalhes</button>
            </div>
        </div>

        <div class="cookie-settings mt-3" id="cookieSettings">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="mb-3">Preferências</h6>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="necessaryCookies" checked disabled>
                        <label class="form-check-label" for="necessaryCookies">
                            <strong>Cookies necessários</strong>
                            <div class="text small">Esses cookies são essenciais para o bom funcionamento de nosso site.</div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showCookieConsent() {
        const consent = document.getElementById('cookieConsent');
        consent.classList.add('show');
    }

    if (!localStorage.getItem('cookieConsent')) {
        setTimeout(showCookieConsent, 1000);
    }

    function toggleSettings() {
        const settings = document.getElementById('cookieSettings');
        settings.classList.toggle('show');
    }

    function acceptAll() {
        saveCookiePreferences();
    }

    function saveCookiePreferences() {
        const consent = document.getElementById('cookieConsent');

        localStorage.setItem('cookieConsent', 'true');

        consent.classList.add('hiding');
        setTimeout(() => {
            consent.classList.remove('show', 'hiding');
        }, 300);

        console.log('Preferences saved:');
    }
</script>