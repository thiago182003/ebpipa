if (document.querySelector('#cpf')) {
    new Cleave('#cpf', {
        delimiters: ['.', '.', '-'],
        blocks: [3, 3, 3, 2],
        numericOnly: true,
    });
}

if (document.querySelector('#cnpj')) {
    var cnpj = new Cleave('#cnpj', {
        delimiters: ['.', '.', '/', '-'],
        blocks: [2, 3, 3, 4, 2],
        numericOnly: true,
    });
}

// if (document.querySelector('#telefone')) {
//     new Cleave("#telefone", {
//         delimiters: ['(', ')', ' ', '-'],
//         blocks: [0, 2, 0, 5, 4],
//         numericOnly: true,
//     });
// }

// if (document.querySelector('.telefone')) {
//     new Cleave(".telefone", {
//         delimiters: ['(', ')', ' ', '-'],
//         blocks: [0, 2, 0, 5, 4],
//         numericOnly: true,
//     });
// }

const telefones = document.querySelectorAll('.telefone');

telefones.forEach(telefone => {
    new Cleave(telefone, {
        delimiters: ['(', ')', ' ', '-'],
        blocks: [0, 2, 0, 5, 4],
        numericOnly: true,
    });
});

if (document.querySelector('#cep')) {
    new Cleave("#cep", {
        delimiters: ['-'],
        blocks: [5, 3],
        numericOnly: true,
    });
}

if (document.querySelector('#placa')) {
    new Cleave("#placa", {
        delimiters: ['-'],
        blocks: [3, 4],
    });
}

if (document.querySelector('.data')) {
    new Cleave(".data", {
        date: true,
        dateMin: now(),
        delimiter: '/',
        datePattern: ['d', 'm', 'Y']
    });
}

