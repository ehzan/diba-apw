function puzzle7(data) {
    const pairs = data.trim().split(/\r?\n/);
    let count = 0;
    for (let pair of pairs) {
        [a1, a2, b1, b2] = pair.split(/[-,]/);  // a1-a2,b1-b2
        count += (parseInt(a1) <= parseInt(b1) && parseInt(b2) <= parseInt(a2)) ||
            (parseInt(b1) <= parseInt(a1) && parseInt(a2) <= parseInt(b2));
    }
    return count;
}

function puzzle8(data) {
    const pairs = data.trim().split(/\r?\n/);
    let count = 0;
    for (let pair of pairs) {
        [a1, a2, b1, b2] = pair.split(/[-,]/);  // a1-a2,b1-b2
        count += (parseInt(a1) <= parseInt(b1) && parseInt(b1) <= parseInt(a2)) ||
            (parseInt(b1) <= parseInt(a1) && parseInt(a1) <= parseInt(b2));
    }
    return count;
}

btnSolve.addEventListener('click', () => {
    let input_file = fileInput.files[0];
    if (input_file) {
        const dataPromise = read_file(input_file);
        dataPromise.then((data) => {
            preInput.innerText = data;
            pResult.innerText = `Day #4, part one: ${puzzle7(data)}`;
            pResult.innerText += '\n' + `Day #4, part two: ${puzzle8(data)}`;
        });
    }
});
