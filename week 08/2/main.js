const input="be happy";
let chars=['a','e','u','i','o'];
let arrayOfChar=input.split("");
let count=arrayOfChar.filter(c=> chars.includes(c)).length;
let arrayOfword=input.split(" ");
for (let i=0;i< arrayOfword.length;i++){
    if (arrayOfword[i].charAt(arrayOfword[i].length-1)=='y'){

        count++;
    }
    if (arrayOfword[i].length>1) {
        if (arrayOfword[i].charAt(arrayOfword[i].length - 1) == 'w' && chars.includes(arrayOfword[i].charAt(arrayOfword[i].length - 2))) {
            count++;
        }
    }
}
console.log(count);