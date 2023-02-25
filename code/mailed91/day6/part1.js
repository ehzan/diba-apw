const input = document.getElementsByTagName('pre')[0].innerText.trim()
const marker = []
const inputLength = input.length
for(var i = 0; i < inputLength; i++){
    marker.push(input[i]);
    if(marker.length < 4){
        continue
    }
    const uniqueMarker = [...new Set(marker)];
    if(uniqueMarker.length === 4){
        console.log(1 + i)
        break
    }
    marker.shift();
}