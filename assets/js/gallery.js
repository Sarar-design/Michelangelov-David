
(function () {
    const images = window.GALLERY_IMAGES || [];
    if (!images.length) return;

    const overlay = document.getElementById('lightbox');
    const imgEl = document.getElementById('lightboxImg');
    const captionEl = document.getElementById('lightboxCaption');
    const btnClose = document.getElementById('lightboxClose');
    const btnPrev = document.getElementById('lightboxPrev');
    const btnNext = document.getElementById('lightboxNext');

    let currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        updateImage();
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    function updateImage() {
        const item = images[currentIndex];
        imgEl.src = item.src;
        imgEl.alt = item.title;
        captionEl.textContent = `${item.title} — ${item.desc}`;
    }

    function next() {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    }

    function prev() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    }

    document.querySelectorAll('.gallery-item').forEach((el) => {
        el.addEventListener('click', () => openLightbox(parseInt(el.dataset.index, 10)));
    });

    btnClose.addEventListener('click', closeLightbox);
    btnNext.addEventListener('click', next);
    btnPrev.addEventListener('click', prev);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', (e) => {
        if (!overlay.classList.contains('open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') next();
        if (e.key === 'ArrowLeft') prev();
    });
})();
