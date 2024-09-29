let input="hello book hell php js php jquery dom hello hello";
let arrayOfWords=input.split(" ");
let readWord=new Array();
let result={};
for (let i=0;i<arrayOfWords.length;i++ ){
    if (!readWord.includes(arrayOfWords[i])){
        let numOfWord=1;
        for (let j=i+1;j<arrayOfWords.length;j++){
            if (arrayOfWords[j]==arrayOfWords[i]){
                numOfWord++;
            }
        }
        readWord.push(arrayOfWords[i]);
        result[arrayOfWords[i]]=numOfWord;
    }
}
console.log(result);