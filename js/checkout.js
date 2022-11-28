/* ###################### checkout script starts ######################*/
// const form = qryS('#checkout');
const form = document.getElementById('checkout');
const concats = qrySA('.checkout .container .concat');
const prevCheckout = document.getElementById('prev-checkout'),
    nextCheckout = document.getElementById('next-checkout');
const concatSize = concats.length - 1;


window.onload = () => {
    for (var i = 0; i < concatSize; i++) {
        current = concats[i].classList.contains('current'); //bool
        if (current && !('shipping-method' in concats[i].classList)) {
            // console.log('div not first element!'); //debug
            concats[i].classList.remove('current');
            qryS('.shipping-method').classList.add('current');
            return;
        }
    }
};

function previousFormPage() {
    for (var i = concatSize - 1; i > 0; i--) { //concatSize - 1 navigation limit size
        let current = concats[i];
        let previous = concats[i - 1];
        if (isReceipt()) {
            nextCheckout.style.setProperty('display', 'flex');
            previous = concats[i - 2]; // go back twice
        }
        if (current.classList.contains('current')) {
            current.classList.remove('current');
            previous.classList.add('current');
            //   console.log(current); //debug
            //   console.log(previous); //debug
            break;
        }
    }
    isReviewPurchase(); //redudancy
    checkCredencial();
}

function nextFormPage() {
    for (var i = 0; i < concatSize; i++) {
        var current = concats[i];
        var next = concats[i + 1];
        if (current.classList.contains('current')) {
            current.classList.remove('current');
            next.classList.add('current');
            //   console.log(current); //debug
            //   console.log(next); //debug
            break;
        }
    }
    if (isReceipt()) {
        checkCredencial();
    }
    isReviewPurchase(); //redudancy
    isCheckoutComplete(); //redudancy
};

const isReceipt = () => {
    let receipt = qryS('.receipt-data.current');
    if ('className' in receipt) {
        // console.log(receipt); //debug
        return true;
    }
    return false;
}
const isReviewPurchase = () => {
    let reviewPurchase = qryS('.review-purchase.current');
    if ('className' in reviewPurchase) {
        // console.log(reviewPurchase); //debug
        nextCheckout.style.removeProperty('display');
        writeDetails();
    }
}
const isCheckoutComplete = () => {
    let checkoutComplete = qryS('.checkout-complete.current');
    if ('className' in checkoutComplete) {
        // console.log(checkoutComplete); //debug
        nextCheckout.style.removeProperty('display');
    }
}
// prev button
// if (prevCheckout == !null) {
prevCheckout.addEventListener('click', () => {
    previousFormPage();
});
// }
// next button
// if (nextCheckout == !null) {
nextCheckout.addEventListener('click', () => {
    nextFormPage();

});
// }
let selectedRadio = [];
// selectedRadio[0] --> shipping-method
// selectedRadio[1] --> payment-method
// selectedRadio[2] --> boleto ou credito
function writeDetails() {
    locationDetail = qryS('.location p span');
    shippingDetail = qryS('.shipping p span');
    paymentDetail = qryS('.payment-content p span');
    shippingDetail.innerHTML = `${selectedRadio[0].toUpperCase()}`;
    paymentDetail.innerHTML = `${selectedRadio[1].toUpperCase()}`;
};

//.........::::++++++++++++++++++Form-Validation ++++++++++++++++::::.........

const checkTipoEntrega = (element) => {
    let valid = false;
    const shippingMethod = element.target.value;
    console.log(shippingMethod); //debug
    selectedRadio[0] = shippingMethod;
    if (shippingMethod) {
        valid = true;
        nextFormPage();
    }
    return valid;
};

const checkTipoPagamento = (element) => {
    let valid = false;
    const payMethod = element.target.value;
    console.log(payMethod); //debug
    selectedRadio[1] = payMethod;
    if (payMethod == 'boleto') {
        // selectedRadio[2] = qryS('input[id="row1"]').value;
        selectedRadio[2] = document.getElementById('row1').value;
        console.log(selectedRadio[2] + 'checktipopagamento :: boleto+preco'); //debug
        // console.log(selectedRadio[2][0]); //debug
        // console.log(selectedRadio[2][1]); //debug
        for (i = 0; i < 2; i++) {
            nextFormPage();
        }
        valid = true;
    }
    else if (payMethod == 'credito') {
        console.log('checktipopagamento :: cartao'); //debug
        valid = true;
        nextFormPage();
    }
    else {
        console.log('incorrect selected value!'); //debug
    }
    return valid;
};

const checkItm = (element) => {
    // input not required
    // let valid = false;
    const itm = element.target.value;
    // console.log(itm); //debug
    selectedRadio[2] = JSON.parse(itm);
    console.log(selectedRadio[2] + ' checkitm :: parcela'); //debug
    // console.log(selectedRadio[2][0]); //debug
    // console.log(selectedRadio[2][1]); //debug
    if (itm) {
        nextFormPage();
        // valid = true; //forced select
    }
    // return valid; //forced select
};

const credType = document.querySelector('select[id="data-id"]'),
    credValue = document.querySelector('input[id="data-number"]'),
    cardfigureval = document.querySelector('.card-figure .di span'),
    cardfigure = document.querySelector('.card-figure .di p');
// if (credValue == !null) {
credValue.addEventListener('keyup', function () {
    // console.log(credValue.value); //debug
    cardfigureval.innerHTML = credValue.value;
    checkCredencial();
});
// }

// if (credType == !null) {
credType.addEventListener('change', () => {
    // console.log(credType.value); //debug
    cardfigure.innerHTML = (`${credType.value}&nbsp;&nbsp;&nbsp;`);
    credValue.value = '';
    checkCredencial();
});
// }

const checkCredencial = () => {
    // return void()
    let valid = false;
    const cpf = credValue.value.trim();
    const rg = credValue.value.trim();
    const cnpj = credValue.value.trim();

    switch (credType.value) {
        case ('cpf'):
            credValue.placeholder = '123.456.789-10';
            if (!isRequired(cpf)) {
                showError(credValue, 'cpf não pode estar em branco.');
            } else if (!isCpfValid(cpf)) {
                showError(credValue, `cpf dever estar com o seguinte padrão: "123.456.789-10".`)
            } else {
                showSuccess(credValue);
                valid = true;
            }
            break;
        case ('rg'):
            credValue.placeholder = '12.345.678-9';
            if (!isRequired(rg)) {
                showError(credValue, 'rg não pode estar em branco.');
            } else if (!isRgValid(rg)) {
                showError(credValue, 'rg dever estar com o seguinte padrão: "12.345.678-9".')
            } else {
                showSuccess(credValue);
                valid = true;
            }
            break;
        case ('cnpj'):
            credValue.placeholder = '12.345.678/9101-11';
            if (!isRequired(cnpj)) {
                showError(credValue, 'cnpj não pode estar em branco.');
            } else if (!isCnpjValid(cnpj)) {
                showError(credValue, 'cnpj dever estar com o seguinte padrão: "12.345.678/9101-11"');
            } else {
                showSuccess(credValue);
                valid = true;
            }
            break;
    }
    // console.log(valid + 'show next button'); //debug
    if (valid) {
        // show next button if valid
        nextCheckout.style.setProperty('display', 'flex');
        isReviewPurchase();
        isCheckoutComplete();
    }
    return valid;
};


const isCpfValid = (cpf) => {
    const cpfRegex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
    return cpfRegex.test(cpf);
};
const isRgValid = (rg) => {

    const rgRegex = /(^\d{2}\.\d{3}\.\d{3}\-\d{1}$)/;
    return rgRegex.test(rg);
};

const isCnpjValid = (cnpj) => {
    const cnpjRegex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/;
    return cnpjRegex.test(cnpj);
};

const isRequired = value => value === '' ? false : true;



const showError = (input, message) => {
    // exibe conotação de erro no layout do 'input'
    if (!input.classList.contains('error')) {
        input.classList.remove('success');
        input.classList.add('error');
    }

    // elemento com classe form-field
    const formField = input.parentElement;
    // exibe mensagem de erro com layout
    const error = formField.querySelector('small.message');
    error.classList.remove('success');
    error.classList.add('error');
    error.textContent = message;
};

const showSuccess = (input) => {
    if (!input.classList.contains('success')) {
        input.classList.remove('error');
        input.classList.add('success');
    }

    const formField = input.parentElement;
    const error = formField.querySelector('small.message');
    error.classList.remove('error');
    error.classList.add('success');
    error.textContent = '';
}

// if (form == !null) {
form.addEventListener('submit', function (event) {
    // console.log(event);

    // evita o envio do formulário
    event.preventDefault();

    // validate fields
    let
        radioSteps = (!selectedRadio.length == 0),
        isCredencialValid = checkCredencial();

    let
        isFormValid =
            radioSteps &&
            isCredencialValid;


    if (event.submitter.name == 'purchase') {
        // console.log('Acionar compra'); //debug
        event.submitter.innerHTML = '<br/>';
    }

    // envia o formulário para o servidor se válido, retornando 'true'
    if (isFormValid) {
        const submitBtnNode = document.createElement("i");
        submitBtnNode.setAttribute('class', 'fas fa-circle-check');
        // alert('Compra efetuada com sucesso!');
        setTimeout(function () {
            setTimeout(function () {
                nextFormPage();
                setTimeout(function () { form.submit(); form.reset(); }, 3000);
            }, 2000);
            event.submitter.innerHTML = '';
            return event.submitter.appendChild(submitBtnNode);
        }, 1000);
    }
});
// }

const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancela o timer anterior
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // começa novo timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};


// if (form == !null) {
form.addEventListener('input', debounce(function (event) {
    // console.log(event); //debug
    switch (event.target.name) {
        case 'tipoEntrega':
            checkTipoEntrega(event);
            break;
        case 'tipoPagamento':
            checkTipoPagamento(event);
            break;
        case 'installment':
            checkItm(event);
            break;
        case 'credencial':
            checkCredencial();
            break;
    }
}));
// }