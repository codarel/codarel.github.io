// validasi login username=codarel password=codarel123
let attempt = 3;
function loginValidate() {
  let username = document.querySelector(".pengguna").value;
  let password = document.querySelector(".kunci").value;
  if (username == "codarel" && password == "codarel123") {
    alert("Login berhasil!");
    window.location = "home.html";
    return false;
  } else {
    attempt--;
    alert(`Login gagal, kamu punya ${attempt} kesempatan untuk mencoba lagi!`);
    if (attempt == 0) {
      document.querySelector("pengguna").disabled = true;
      document.querySelector("kunci").disabled = true;
      document.getElementById("submit").disabled = true;
      return false;
    }
  }
}

// membuka tab pada halaman home dan store
function openTab(evt, tabName) {
  let i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

function myFunction() {
  const x = document.getElementById("myTopnav");
  if (x.className === "nav") {
    x.className += " responsive";
  } else {
    x.className = "nav";
  }
}

const myInput = document.getElementById("password");
const letter = document.getElementById("letter");
const capital = document.getElementById("capital");
const number = document.getElementById("number");
const length = document.getElementById("length");
const confirmPass = document.getElementById("confirm");
const same = document.getElementById("same");

// ketika pengguna mengklik kolom password, tampilkan pesan
myInput.onfocus = function () {
  document.getElementById("message").style.display = "block";
};

// ketika pengguna mengklik luar dari kolom password, sembunyikan pesan
myInput.onblur = function () {
  document.getElementById("message").style.display = "none";
};

// ketika pengguna memasukkan sesuatu ke dalam kolom password
myInput.onkeyup = function () {
  // Validasi huruf kecil
  const lowerCaseLetters = /[a-z]/g;
  if (myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }

  // Validasi huruf besar
  const upperCaseLetters = /[A-Z]/g;
  if (myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validasi angka
  const numbers = /[0-9]/g;
  if (myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validasi panjang huruf
  if (myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
};

// ketika pengguna mengklik kolom konfirmasi password, tampilkan pesan
confirmPass.onfocus = function () {
  document.getElementById("message2").style.display = "block";
};

// ketika pengguna mengklik luar dari kolom konfirmasi password, sembunyikan pesan
confirmPass.onblur = function () {
  document.getElementById("message2").style.display = "none";
};

// ketika pengguna memasukkan sesuatu ke dalam kolom konfirmasi password
confirmPass.onkeyup = function () {
  // Validate password
  if (confirmPass.value == myInput.value) {
    same.classList.remove("invalid");
    same.classList.add("valid");
  } else {
    same.classList.remove("valid");
    same.classList.add("invalid");
  }
};
