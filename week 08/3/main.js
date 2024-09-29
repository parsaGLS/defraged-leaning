let a=document.getElementById("a").value;
function setP() {

    let b=document.getElementById("b");
    let realP=document.getElementById("a").value;
    let revP="";
    for (let i=realP.length-1;i>=0;i--){
        revP+=realP.charAt(i);
    }

    b.innerText=revP;
}