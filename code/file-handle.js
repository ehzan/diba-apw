function read_file(input_file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => { resolve(reader.result); };
        reader.onerror = () => { reject('Error in loading file!'); };
        reader.readAsText(input_file);
    });
}
