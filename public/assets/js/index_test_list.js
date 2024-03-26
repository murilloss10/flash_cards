window.addEventListener('load', (event) => {
    let card = document.querySelector('.flip-card-inner');
    
    card.addEventListener('click', () => {
        card.classList.toggle('is-flipped');
    });
});

async function fillModalInitialTest(list) {
    let title = document.querySelector(`#modalInitialTest #modalInitialTestLabel`);
    title.textContent = list['name']

    const response  = await fetch(`/listas/${list['id']}/cards`);
    const cards     = await response.json();

    let index           = 0;
    let nextButton      = document.querySelector('#next-card');
    let previousButton  = document.querySelector('#previous-card');
    let inputTestListId = document.querySelector('#input_test_list_id');
    let inputTotalQuest = document.querySelector('#input_total_questions');
    let arrayIncorrects = [];
    let arrayCorrects   = [];

    inputTestListId.value = list['id'];
    inputTotalQuest.value = cards.length;

    checkButtons(index, cards.length, previousButton, nextButton);
    fillIndexCardModal(cards, list, index, arrayIncorrects, arrayCorrects);

    nextButton.addEventListener('click', (event) => {
        event.preventDefault();
        disableCardFlipped();

        setTimeout(() => {
            if (index < cards.length - 1) {
                index++;
                fillIndexCardModal(cards, list, index, arrayIncorrects, arrayCorrects);
            }

            checkButtons(index, cards.length, previousButton, nextButton);
        }, 500);
    });
    
    previousButton.addEventListener('click', (event) => {
        event.preventDefault();
        disableCardFlipped();

        setTimeout(() => {
            if (index > 0) {
                index--;
                fillIndexCardModal(cards, list, index, arrayIncorrects, arrayCorrects);
            }

            checkButtons(index, cards.length, previousButton, nextButton);
        }, 500);
    });
}

function fillIndexCardModal(cards, list, index, arrayIncorrects, arrayCorrects) {
    let card            = Object.values(cards)[index];
    let countQuestions  = document.querySelector(`#modalTest #modalTestLabel`);
    let indexInfo       = ++index;

    countQuestions.textContent = indexInfo + '/' + cards.length;

    fillCardModal(card, list, index, arrayIncorrects, arrayCorrects);
}

function fillCardModal(card, list, index, arrayIncorrects, arrayCorrects) {
    const modal                     = document.querySelector('#modalTest');    
    const card_                     = Object.values(card)[0];
    const buttonsIncorrectCorrect   = document.querySelectorAll('.incorrect, .correct');
    const buttonIncorrectCorrect    = document.querySelectorAll(`#incorrect-${index}, #correct-${index}`);
    let inputCorrects               = document.querySelector('#input_corrects');
    let inputIncorrects             = document.querySelector('#input_incorrects');
    
    if (buttonsIncorrectCorrect.length > 0) {
        buttonsIncorrectCorrect.forEach(element => {
            if (element.id === `incorrect-${index}` || element.id === `correct-${index}`) {
                element.classList.toggle('d-none');
            } else {
                element.classList.add('d-none');
            }
        });
    }

    if (buttonIncorrectCorrect.length === 0) {
        createButtonsIncorrectCorrect(index);
        createEventsButtonsIncorrectCorrect(index, arrayIncorrects, arrayCorrects, card_['id'], inputCorrects, inputIncorrects);
    }

    modal.querySelector('#p-card-id').textContent           = card_['id'];
    modal.querySelector('#p-topic').textContent             = card_['topic'];
    modal.querySelector('#p-list-name').textContent         = list['name'];
    modal.querySelector('#p-question').textContent          = card_['question'];
    modal.querySelector('#p-question-answer').textContent   = card_['question_answer'];
}

function disableCardFlipped() {
    document.querySelectorAll('.flip-card-inner.is-flipped').forEach(card => {
        card.classList.remove('is-flipped');
    });
}

function createButtonsIncorrectCorrect(index) {
    let divButtons = document.querySelector('#buttonsCard');
    
    let buttonIncorrect = document.createElement('button');
    let buttonCorrect   = document.createElement('button');
    let iconClose       = document.createElement('span');
    let iconCheck       = document.createElement('span');
    
    buttonIncorrect.classList.add('btn', 'btn-danger', 'p-2', 'm-1', 'incorrect');
    buttonCorrect.classList.add('btn', 'btn-success', 'p-2', 'm-1', 'correct');

    buttonIncorrect.id  = `incorrect-${index}`;
    buttonCorrect.id    = `correct-${index}`;

    iconClose.classList.add('material-symbols-outlined', 'align-middle');
    iconCheck.classList.add('material-symbols-outlined', 'align-middle');
    iconClose.append('close');
    iconCheck.append('check');

    buttonIncorrect.append(iconClose);
    buttonCorrect.append(iconCheck);

    divButtons.prepend(buttonIncorrect);
    divButtons.prepend(buttonCorrect);
}

function createEventsButtonsIncorrectCorrect(index, arrayIncorrects, arrayCorrects, card_id, inputCorrects, inputIncorrects) {
    let incorrectButton     = document.querySelector(`#incorrect-${index}`);
    let correctButton       = document.querySelector(`#correct-${index}`);

    incorrectButton.addEventListener('click', (event) => {
        event.preventDefault();

        let correct         = document.querySelector(`#correct-${index}`);
        correct.disabled    = true;

        if (!arrayIncorrects.includes(card_id))
            arrayIncorrects.push(card_id);
    
        inputIncorrects.value = arrayIncorrects.length;
    });
    
    correctButton.addEventListener('click', (event) => {
        event.preventDefault();
        
        let incorrect       = document.querySelector(`#incorrect-${index}`);
        incorrect.disabled  = true;
        
        if (!arrayCorrects.includes(card_id))
            arrayCorrects.push(card_id);
    
        inputCorrects.value = arrayCorrects.length;
        
    });
}

function checkButtons(index, cardsLength, previousButton, nextButton) {
    index === 0 ? buttonDisabled(previousButton, true) : buttonDisabled(previousButton, false);

    let buttonResult = document.querySelector('#result');

    if (index === (cardsLength - 1)) {
        buttonDisabled(nextButton, true);
        buttonResult.classList.remove('d-none');
    } else {
        buttonDisabled(nextButton, false);
        buttonResult.classList.add('d-none');
    }
}

function buttonDisabled(button, itsDisabled = true) {
    button.disabled = itsDisabled;
}

function editPage(list) {
    window.location.href = `/listas/${list['id']}/editar`;
}