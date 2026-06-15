document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // ハンバーガーメニュー
    // ============================================================
    var burger     = document.getElementById('burger');
    var mobileMenu = document.getElementById('mobileMenu');

    if (burger && mobileMenu) {
        burger.addEventListener('click', function () {
            var isOpen = mobileMenu.classList.toggle('is-open');
            burger.classList.toggle('is-open', isOpen);
            burger.setAttribute('aria-expanded', isOpen);
            mobileMenu.setAttribute('aria-hidden', !isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // メニュー外タップで閉じる
        mobileMenu.addEventListener('click', function (e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.remove('is-open');
                burger.classList.remove('is-open');
                burger.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        });
    }


    // ============================================================
    // スクロールリビール（.js-reveal）
    // ============================================================
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion && 'IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target);
            });
        }, {
            rootMargin: '0px 0px -10% 0px',
            threshold: 0.12
        });

        document.querySelectorAll('.js-reveal').forEach(function (el) {
            revealObserver.observe(el);
        });
    } else {
        document.querySelectorAll('.js-reveal').forEach(function (el) {
            el.classList.add('is-revealed');
        });
    }


    // ============================================================
    // ヘッダー：スクロールで背景を変える
    // ============================================================
    var header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('is-scrolled', window.scrollY > 40);
        }, { passive: true });
    }


    // ============================================================
    // Works もっとみる
    // ============================================================
    var worksMoreButton = document.querySelector('.js-works-more');

    if (worksMoreButton) {
        var initialWorkCount = 6;

        worksMoreButton.addEventListener('click', function () {
            var isExpanded = worksMoreButton.getAttribute('aria-expanded') === 'true';
            var workCards = Array.prototype.slice.call(document.querySelectorAll('.work-card'));
            var buttonText = worksMoreButton.querySelector('span');

            if (isExpanded) {
                workCards.forEach(function (card, index) {
                    var shouldHide = index >= initialWorkCount;
                    card.hidden = shouldHide;
                    card.classList.toggle('is-hidden', shouldHide);
                });
                worksMoreButton.setAttribute('aria-expanded', 'false');
                if (buttonText) buttonText.textContent = 'もっとみる';
                document.getElementById('works')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                return;
            }

            workCards.forEach(function (card) {
                card.hidden = false;
                card.classList.remove('is-hidden');
            });
            worksMoreButton.setAttribute('aria-expanded', 'true');
            if (buttonText) buttonText.textContent = '閉じる';
        });
    }


    // ============================================================
    // Works モーダル
    // ============================================================
    var workModal = document.getElementById('workModal');
    var lastFocusedWorkTrigger = null;

    if (workModal) {
        var modalTitle = document.getElementById('workModalTitle');
        var modalOverview = document.getElementById('workModalOverview');
        var modalClient = document.getElementById('workModalClient');
        var modalPeriod = document.getElementById('workModalPeriod');
        var modalTags = document.getElementById('workModalTags');
        var modalDetails = document.getElementById('workModalDetails');
        var modalGallery = document.getElementById('workModalGallery');
        var modalSite = document.getElementById('workModalSite');
        var modalCloseButtons = workModal.querySelectorAll('.js-work-modal-close');

        var closeWorkModal = function () {
            workModal.classList.remove('is-open');
            workModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            if (lastFocusedWorkTrigger) {
                lastFocusedWorkTrigger.focus();
            }
        };

        var openWorkModal = function (trigger) {
            var tags = [];
            var details = [];
            var images = [];

            try {
                tags = JSON.parse(trigger.dataset.workTags || '[]');
            } catch (error) {
                tags = [];
            }

            try {
                details = JSON.parse(trigger.dataset.workDetails || '[]');
            } catch (error) {
                details = [];
            }

            try {
                images = JSON.parse(trigger.dataset.workImages || '[]');
            } catch (error) {
                images = [];
            }

            if (modalTitle) modalTitle.textContent = trigger.dataset.workTitle || '';
            if (modalOverview) modalOverview.textContent = trigger.dataset.workOverview || '';
            if (modalClient) modalClient.textContent = trigger.dataset.workClient || '';
            if (modalPeriod) modalPeriod.textContent = (trigger.dataset.workPeriod || '').replace('制作期間：', '');

            if (modalGallery) {
                modalGallery.innerHTML = '';
                images.forEach(function (image, index) {
                    var figure = document.createElement('figure');
                    figure.className = 'work-modal-image';

                    if (image.src) {
                        var img = document.createElement('img');
                        img.src = image.src;
                        img.alt = image.alt || '';
                        figure.appendChild(img);
                    } else {
                        var placeholder = document.createElement('span');
                        placeholder.className = 'work-modal-image-placeholder';
                        placeholder.textContent = 'Image ' + String(index + 1).padStart(2, '0');
                        figure.appendChild(placeholder);
                    }

                    modalGallery.appendChild(figure);
                });
            }

            if (modalDetails) {
                modalDetails.innerHTML = '';
                details.forEach(function (text) {
                    var paragraph = document.createElement('p');
                    paragraph.textContent = text;
                    modalDetails.appendChild(paragraph);
                });
            }

            if (modalTags) {
                modalTags.innerHTML = '';
                tags.forEach(function (tag) {
                    var item = document.createElement('li');
                    item.textContent = tag;
                    modalTags.appendChild(item);
                });
            }

            if (modalSite) {
                var siteUrl = trigger.dataset.workSiteUrl || '#';
                modalSite.href = siteUrl;
                modalSite.classList.toggle('is-disabled', siteUrl === '#');
                modalSite.setAttribute('aria-disabled', siteUrl === '#' ? 'true' : 'false');
            }

            lastFocusedWorkTrigger = trigger;
            workModal.classList.add('is-open');
            workModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            var closeButton = workModal.querySelector('.work-modal-close');
            if (closeButton) closeButton.focus();
        };

        document.querySelectorAll('.js-work-modal-open').forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                openWorkModal(trigger);
            });
        });

        modalCloseButtons.forEach(function (button) {
            button.addEventListener('click', closeWorkModal);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && workModal.classList.contains('is-open')) {
                closeWorkModal();
            }
        });
    }


    // ============================================================
    // Service モーダル
    // ============================================================
    var serviceModal = document.getElementById('serviceModal');
    var lastFocusedServiceTrigger = null;

    if (serviceModal) {
        var serviceModalTitle = document.getElementById('serviceModalTitle');
        var serviceModalLead = document.getElementById('serviceModalLead');
        var serviceModalLeadDetails = document.getElementById('serviceModalLeadDetails');
        var serviceModalTags = document.getElementById('serviceModalTags');
        var serviceModalDeliverables = document.getElementById('serviceModalDeliverables');
        var serviceModalDuration = document.getElementById('serviceModalDuration');
        var serviceModalPrice = document.getElementById('serviceModalPrice');
        var serviceModalVisualText = document.getElementById('serviceModalVisualText');
        var serviceModalCloseButtons = serviceModal.querySelectorAll('.js-service-modal-close');
        var serviceModalContact = serviceModal.querySelector('.service-modal-contact');

        var closeServiceModal = function () {
            serviceModal.classList.remove('is-open');
            serviceModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            if (lastFocusedServiceTrigger) {
                lastFocusedServiceTrigger.focus();
            }
        };

        var openServiceModal = function (trigger) {
            var details = [];
            var tags = [];
            var deliverables = [];

            try {
                details = JSON.parse(trigger.dataset.serviceDetails || '[]');
            } catch (error) {
                details = [];
            }

            try {
                tags = JSON.parse(trigger.dataset.serviceTags || '[]');
            } catch (error) {
                tags = [];
            }

            try {
                deliverables = JSON.parse(trigger.dataset.serviceDeliverables || '[]');
            } catch (error) {
                deliverables = [];
            }

            if (serviceModalTitle) serviceModalTitle.textContent = trigger.dataset.serviceTitle || '';
            if (serviceModalLead) serviceModalLead.textContent = trigger.dataset.serviceLead || '';
            if (serviceModalDuration) serviceModalDuration.textContent = trigger.dataset.serviceDuration || '';
            if (serviceModalPrice) serviceModalPrice.textContent = trigger.dataset.servicePrice || '';
            if (serviceModalVisualText) serviceModalVisualText.textContent = trigger.dataset.serviceTitle || '';

            if (serviceModalLeadDetails) {
                serviceModalLeadDetails.innerHTML = '';
                details.forEach(function (text) {
                    var paragraph = document.createElement('p');
                    paragraph.textContent = text;
                    serviceModalLeadDetails.appendChild(paragraph);
                });
            }

            if (serviceModalTags) {
                serviceModalTags.innerHTML = '';
                tags.forEach(function (tag) {
                    var item = document.createElement('li');
                    item.textContent = tag;
                    serviceModalTags.appendChild(item);
                });
            }

            if (serviceModalDeliverables) {
                serviceModalDeliverables.innerHTML = '';
                deliverables.forEach(function (itemText) {
                    var item = document.createElement('li');
                    item.textContent = itemText;
                    serviceModalDeliverables.appendChild(item);
                });
            }

            lastFocusedServiceTrigger = trigger;
            serviceModal.classList.add('is-open');
            serviceModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            var closeButton = serviceModal.querySelector('.service-modal-close');
            if (closeButton) closeButton.focus();
        };

        document.querySelectorAll('.js-service-modal-open').forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                openServiceModal(trigger);
            });
        });

        serviceModalCloseButtons.forEach(function (button) {
            button.addEventListener('click', closeServiceModal);
        });

        if (serviceModalContact) {
            serviceModalContact.addEventListener('click', closeServiceModal);
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && serviceModal.classList.contains('is-open')) {
                closeServiceModal();
            }
        });
    }


    // ============================================================
    // プライバシーポリシー モーダル
    // ============================================================
    var privacyModal = document.getElementById('privacyModal');
    var lastFocusedPrivacyTrigger = null;

    if (privacyModal) {
        var privacyCloseButtons = privacyModal.querySelectorAll('.js-privacy-modal-close');

        var closePrivacyModal = function () {
            privacyModal.classList.remove('is-open');
            privacyModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            if (lastFocusedPrivacyTrigger) {
                lastFocusedPrivacyTrigger.focus();
            }
        };

        var openPrivacyModal = function (trigger) {
            lastFocusedPrivacyTrigger = trigger;
            privacyModal.classList.add('is-open');
            privacyModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            var closeButton = privacyModal.querySelector('.privacy-modal-close');
            if (closeButton) closeButton.focus();
        };

        document.querySelectorAll('a[href="/privacypolicy"], a[href$="/privacypolicy"]').forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                openPrivacyModal(trigger);
            });
        });

        privacyCloseButtons.forEach(function (button) {
            button.addEventListener('click', closePrivacyModal);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && privacyModal.classList.contains('is-open')) {
                closePrivacyModal();
            }
        });
    }


    // ============================================================
    // FAQ アコーディオン
    // ============================================================
    document.querySelectorAll('.faq-item').forEach(function (item) {
        var summary = item.querySelector('summary');
        var panel = item.querySelector('.faq-panel');

        if (!summary || !panel) return;

        summary.addEventListener('click', function (e) {
            e.preventDefault();

            var isOpen = item.open;

            if (isOpen) {
                panel.style.height = panel.scrollHeight + 'px';
                item.classList.remove('is-open');

                requestAnimationFrame(function () {
                    panel.style.height = '0px';
                });

                panel.addEventListener('transitionend', function onClose() {
                    item.open = false;
                    panel.removeEventListener('transitionend', onClose);
                });
                return;
            }

            item.open = true;
            item.classList.add('is-open');
            panel.style.height = '0px';

            requestAnimationFrame(function () {
                panel.style.height = panel.scrollHeight + 'px';
            });

            panel.addEventListener('transitionend', function onOpen() {
                panel.style.height = 'auto';
                panel.removeEventListener('transitionend', onOpen);
            });
        });
    });

});
