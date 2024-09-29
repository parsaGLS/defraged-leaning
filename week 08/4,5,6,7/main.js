let id = 1

function deleteRow(id) {
    document.getElementById(id).innerHTML = "";
}

function editRow(id, firstname, lastname, phone) {
    let firstnameIn = document.createElement("input");
    let lastnameIn = document.createElement("input");
    let phoneIn = document.createElement("input");
    let submitBut = document.createElement("button");
    submitBut.innerText = "submit";
    let newsubmitBut = document.createElement("td");
    let newfirstname = document.createElement("td");
    let newlastname = document.createElement("td");
    let newphone = document.createElement("td")
    firstnameIn.type = "text";
    lastnameIn.type = "text";
    phoneIn.type = "text";
    firstnameIn.value = firstname;
    lastnameIn.value = lastname;
    phoneIn.value = phone;

    newfirstname.append(firstnameIn);
    console.log(newlastname)
    newlastname.append(lastnameIn);
    newphone.append(phoneIn);
    newsubmitBut.append(submitBut);

    document.getElementById(id).innerHTML = "";
    document.getElementById(id).append(newphone, newfirstname, newlastname, newsubmitBut);
    submitBut.onclick = () => {
        setEdit(id, firstnameIn.value, lastnameIn.value, phoneIn.value);
    }


}

function setEdit(id, firstname, lastname, phone) {
    let firstnameTd = document.createElement("td");
    let lastnameTd = document.createElement("td");
    let phoneTd = document.createElement("td");
    let button = document.createElement("td")
    let deleteButton = document.createElement("button")
    let editButton = document.createElement("button")
    deleteButton.innerText = "delete";
    editButton.innerText = "edit";
    button.append(deleteButton, editButton)
    firstnameTd.innerText = firstname;
    lastnameTd.innerText = lastname;
    phoneTd.innerText = phone;


    let msg = document.getElementById("msg");
    msg.innerText = "";
    const pattern = /^\d{11}$/;
    if (firstname == "" || lastname == "" || phone == "") {
        msg.innerText = "please complete all field";
    } else if (!pattern.test(phone)) {
        msg.append("phone number format is invalid");
    } else {
        document.getElementById(id).innerHTML = "";
        document.getElementById(id).append(phoneTd, firstnameTd, lastnameTd, button);
        deleteButton.onclick = () => {
            deleteRow(id)
        }
        editButton.onclick = () => {
            editRow(id, firstname, lastname, phone)
        }
    }


}

function addRow(e) {
    e.preventDefault();
    let tr = document.createElement("tr");
    let firstname = document.createElement("td");
    let lastname = document.createElement("td");
    let phone = document.createElement("td")
    let button = document.createElement("td")
    let deleteButton = document.createElement("button")
    let editButton = document.createElement("button")
    let msg = document.getElementById("msg");
    let firstnameVal = document.getElementById("firstname").value
    let lastnameVal = document.getElementById("lastname").value
    let phoneVal = document.getElementById("phone").value
    deleteButton.innerText = "delete";
    editButton.innerText = "edit";
    button.append(deleteButton, editButton);
    firstname.innerText = firstnameVal;
    lastname.innerText = lastnameVal;
    phone.innerText = phoneVal;
    tr.id = `row-${id}`
    deleteButton.onclick = () => {
        deleteRow(tr.id)
    }
    editButton.onclick = () => {
        editRow(tr.id, firstnameVal, lastnameVal, phoneVal)
    }


    id += 1
    tr.append(phone, firstname, lastname, button);
    const pattern = /^\d{11}$/;
    msg.innerText = "";
    if (firstnameVal == "" || lastnameVal == "" || phoneVal == "") {
        msg.innerText = "please complete all field";
    } else if (!pattern.test(phoneVal)) {
        msg.append("phone number format is invalid");
    } else {
        document.getElementById("table").appendChild(tr);
    }


}

let form = document.getElementById("form");
form.addEventListener('submit', addRow);
