// validasi login username=codarel password=codarel123
function loginValidate() {
  const attempt = 3;
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  if (username == "codarel" && password == "codarel123") {
    alert("Login berhasil!");
    window.location = "home.html";
    return false;
  } else {
    attempt--;
    alert(`Login gagal, kamu punya ${attempt} kesempatan untuk mencoba lagi!`);
    if (attempt == 0) {
      document.getElementById("username").disabled = true;
      document.getElementById("password").disabled = true;
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
