
(function () {
    const questions = window.QUIZ_QUESTIONS || [];
    const submitUrl = window.QUIZ_SUBMIT_URL || 'submit.php';
    const checkUrl = 'check.php';

    if (!questions.length) return;

    const screenStart  = document.getElementById('screen-start');
    const screenQuiz   = document.getElementById('screen-quiz');
    const screenResult = document.getElementById('screen-result');

    const playerNameInput = document.getElementById('playerName');
    const btnStart = document.getElementById('btnStart');
    const btnNext  = document.getElementById('btnNext');
    const btnRetry = document.getElementById('btnRetry');

    const questionCounter = document.getElementById('questionCounter');
    const progressBar = document.getElementById('progressBar');
    const questionText = document.getElementById('questionText');
    const optionsWrap = document.getElementById('optionsWrap');
    const feedback = document.getElementById('feedback');
    const timerDisplay = document.getElementById('timerDisplay');

    let current = 0;
    let playerName = '';
    let answers = [];
    let correctCount = 0;
    let timerInterval = null;
    let secondsElapsed = 0;
    let answered = false;

    function formatTime(sec) {
        const m = String(Math.floor(sec / 60)).padStart(2, '0');
        const s = String(sec % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    function startTimer() {
        secondsElapsed = 0;
        timerDisplay.textContent = '00:00';
        timerInterval = setInterval(() => {
            secondsElapsed++;
            timerDisplay.textContent = formatTime(secondsElapsed);
        }, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }

    btnStart.addEventListener('click', () => {
        const name = playerNameInput.value.trim();
        if (!name) {
            playerNameInput.focus();
            playerNameInput.classList.add('is-invalid');
            return;
        }
        playerName = name;
        screenStart.classList.add('d-none');
        screenQuiz.classList.remove('d-none');
        startTimer();
        renderQuestion();
    });

    function renderQuestion() {
        answered = false;
        feedback.className = 'quiz-feedback';
        feedback.textContent = '';
        btnNext.disabled = true;
        btnNext.textContent = current === questions.length - 1 ? 'Zaključi test' : 'Naprej';
        btnNext.innerHTML += ' <i class="fa-solid fa-arrow-right ms-1"></i>';

        const q = questions[current];
        questionCounter.textContent = `Vprašanje ${current + 1} / ${questions.length}`;
        progressBar.style.width = `${(current / questions.length) * 100}%`;
        questionText.textContent = q.vprasanje;
        optionsWrap.innerHTML = '';

        if (q.tip === 'text') {
            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control form-control-lg';
            input.placeholder = 'Vpiši svoj odgovor...';
            input.id = 'textAnswer';
            optionsWrap.appendChild(input);
            input.addEventListener('input', () => {
                btnNext.disabled = input.value.trim() === '';
            });
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && input.value.trim() !== '') {
                    checkAnswer();
                }
            });
        } else {
            const inputType = q.tip === 'checkbox' ? 'checkbox' : 'radio';
            
            const inputName = q.tip === 'checkbox' ? 'opt[]' : 'opt';
            
            (q.odgovori || []).forEach((opt) => {
                const label = document.createElement('label');
                label.className = 'quiz-option';
                label.dataset.value = opt;
                label.innerHTML = `<input type="${inputType}" name="${inputName}" value="${escapeHtml(opt)}"> ${escapeHtml(opt)}`;
                const input = label.querySelector('input');
                input.addEventListener('change', function() {
                    if (q.tip === 'checkbox') {
                        const checked = optionsWrap.querySelectorAll('input:checked');
                        btnNext.disabled = checked.length === 0;
                    } else {
                        btnNext.disabled = false;
                        checkAnswer();
                    }
                });
                optionsWrap.appendChild(label);
            });
        }
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function getSelectedAnswer() {
        const q = questions[current];
        if (q.tip === 'text') {
            const input = document.getElementById('textAnswer');
            return input ? input.value.trim() : '';
        }
        if (q.tip === 'checkbox') {
            return Array.from(optionsWrap.querySelectorAll('input:checked')).map((i) => i.value);
        }
        const checked = optionsWrap.querySelector('input:checked');
        return checked ? checked.value : '';
    }

    function lockOptions() {
        optionsWrap.querySelectorAll('input').forEach((i) => (i.disabled = true));
        optionsWrap.querySelectorAll('.quiz-option').forEach((l) => l.classList.add('disabled'));
    }

    function highlightAnswers(userAnswer, correctAnswer, isCorrect) {
        const q = questions[current];
        if (q.tip === 'text') return;

        const correctArr = Array.isArray(correctAnswer) ? correctAnswer : [correctAnswer];
        const userArr = Array.isArray(userAnswer) ? userAnswer : [userAnswer];

        optionsWrap.querySelectorAll('.quiz-option').forEach((label) => {
            const val = label.dataset.value;
            if (correctArr.includes(val)) {
                label.classList.add('correct');
            } else if (userArr.includes(val)) {
                label.classList.add('incorrect');
            }
        });
    }

    function checkAnswer() {
        if (answered) return;
        const q = questions[current];
        const userAnswer = getSelectedAnswer();

        if (q.tip !== 'text') {
            if (Array.isArray(userAnswer) ? userAnswer.length === 0 : !userAnswer) {
                return;
            }
        }

        answered = true;
        lockOptions();
        btnNext.disabled = true;

        fetch(checkUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: q.id, answer: userAnswer }),
        })
            .then((r) => r.json())
            .then((data) => {
                answers.push({ id: q.id, answer: userAnswer });
                if (data.correct) correctCount++;

                highlightAnswers(userAnswer, data.correctAnswer, data.correct);

                feedback.classList.add('show', data.correct ? 'ok' : 'bad');
                if (data.correct) {
                    feedback.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i>Pravilno!';
                } else {
                    const correctText = Array.isArray(data.correctAnswer) ? data.correctAnswer.join(', ') : data.correctAnswer;
                    feedback.innerHTML = `<i class="fa-solid fa-circle-xmark me-1"></i>Napačno. Pravilen odgovor: <strong>${escapeHtml(String(correctText))}</strong>`;
                }

                btnNext.disabled = false;
            })
            .catch(() => {
                answers.push({ id: q.id, answer: userAnswer });
                btnNext.disabled = false;
            });
    }

    btnNext.addEventListener('click', () => {
        const q = questions[current];
        if ((q.tip === 'text' || q.tip === 'checkbox') && !answered) {
            checkAnswer();
            return;
        }
        if (!answered) return;

        if (current < questions.length - 1) {
            current++;
            renderQuestion();
        } else {
            finishQuiz();
        }
    });

    function finishQuiz() {
        stopTimer();
        progressBar.style.width = '100%';
        screenQuiz.classList.add('d-none');
        screenResult.classList.remove('d-none');

        const percent = Math.round((correctCount / questions.length) * 100);
        document.getElementById('resultScore').textContent = correctCount;
        document.getElementById('resultTime').textContent = formatTime(secondsElapsed);
        document.getElementById('resultPercent').textContent = percent;

        const stars = Math.max(1, Math.round(percent / 20));
        document.getElementById('resultStars').textContent = '★★★★★'.slice(0, stars).padEnd(5, '☆');

        let message = '';
        if (percent >= 90) message = 'Odlično! Pravi poznavalec renesanse. 🏆';
        else if (percent >= 70) message = 'Zelo dobro! Znanje je trdno. 👏';
        else if (percent >= 50) message = 'Dobro, a še je prostor za izboljšanje. 📚';
        else message = 'Priporočamo, da si gradivo še enkrat ogledaš. 💪';
        document.getElementById('resultMessage').textContent = message;

        const saveStatus = document.getElementById('saveStatus');
        saveStatus.textContent = 'Shranjujem rezultat...';

        fetch(submitUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ime: playerName,
                odgovori: answers,
                cas_sekund: secondsElapsed,
            }),
        })
            .then((r) => r.json())
            .then(() => {
                saveStatus.innerHTML = '<i class="fa-solid fa-check text-success me-1"></i>Rezultat je bil shranjen.';
            })
            .catch(() => {
                saveStatus.textContent = 'Rezultata ni bilo mogoče shraniti.';
            });
    }

    btnRetry.addEventListener('click', () => {
        current = 0;
        answers = [];
        correctCount = 0;
        secondsElapsed = 0;
        screenResult.classList.add('d-none');
        screenStart.classList.remove('d-none');
        playerNameInput.value = '';
    });
})();