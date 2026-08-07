
(function () {
    const tipSelect = document.getElementById('tip');
    const optionsSection = document.getElementById('optionsSection');
    const optionsList = document.getElementById('optionsList');
    const btnAddOption = document.getElementById('btnAddOption');
    const textAnswerWrap = document.getElementById('textAnswerWrap');

    if (!tipSelect) return;

    function correctInputType() {
        return tipSelect.value === 'checkbox' ? 'checkbox' : 'radio';
    }

    function refreshCorrectInputs() {
        const type = correctInputType();
        optionsList.querySelectorAll('.option-correct').forEach((input) => {
            input.type = type;
            input.name = type === 'radio' ? 'correct_radio' : 'correct[]';
        });
    }

    function addOptionRow(value = '', isCorrect = false) {
        const row = document.createElement('div');
        row.className = 'input-group mb-2 option-row';
        row.innerHTML = `
            <span class="input-group-text">
                <input type="${correctInputType()}" class="option-correct" ${isCorrect ? 'checked' : ''}
                    ${correctInputType() === 'radio' ? 'name="correct_radio"' : 'name="correct[]"'} title="Pravilen odgovor">
            </span>
            <input type="text" class="form-control option-text" name="options[]" value="${value.replace(/"/g, '&quot;')}" placeholder="Besedilo odgovora" required>
            <button type="button" class="btn btn-outline-danger btn-remove-option"><i class="fa-solid fa-xmark"></i></button>
        `;
        row.querySelector('.btn-remove-option').addEventListener('click', () => row.remove());
        optionsList.appendChild(row);
    }

    btnAddOption.addEventListener('click', () => addOptionRow());

    function toggleSections() {
        const isText = tipSelect.value === 'text';
        optionsSection.classList.toggle('d-none', isText);
        textAnswerWrap.classList.toggle('d-none', !isText);
        refreshCorrectInputs();
    }

    tipSelect.addEventListener('change', toggleSections);
    toggleSections();

    
    const prefillOptions = window.PREFILL_OPTIONS || null;
    const prefillCorrect = window.PREFILL_CORRECT || null;

    if (prefillOptions && prefillOptions.length) {
        prefillOptions.forEach((opt) => {
            const isCorrect = Array.isArray(prefillCorrect)
                ? prefillCorrect.includes(opt)
                : prefillCorrect === opt;
            addOptionRow(opt, isCorrect);
        });
    } else if (optionsList.children.length === 0) {
       
        addOptionRow();
        addOptionRow();
    }

    
    const form = document.getElementById('questionForm');
    form.addEventListener('submit', function (e) {
        if (tipSelect.value !== 'text') {
            const rows = Array.from(optionsList.querySelectorAll('.option-row'));
            if (rows.length < 2) {
                e.preventDefault();
                alert('Dodaj vsaj dva možna odgovora.');
                return;
            }
            const anyChecked = optionsList.querySelector('.option-correct:checked');
            if (!anyChecked) {
                e.preventDefault();
                alert('Označi vsaj en pravilen odgovor.');
            }
        }
    });
})();
