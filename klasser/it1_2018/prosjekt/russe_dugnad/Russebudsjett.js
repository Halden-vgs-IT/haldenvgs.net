console.log("Javascript: connected");
function footer() {
  var btn = document.getElementById('menuButton'); //Justerer størrelse på menyknapp på window onload
  btn.style.fontSize = 'larger';
 var headerheight = document.getElementsByTagName('header')[0].offsetHeight;
 var navheight = document.getElementById('menu').offsetHeight;
 var nav = document.getElementById('menu');
 var contentheight= document.getElementById('content').offsetHeight;
 var footer = document.getElementsByTagName('footer')[0];
 var footerheight = document.getElementsByTagName('footer')[0].offsetHeight;
   if ((headerheight+contentheight+footerheight+navheight)<= window.innerHeight) {
     footer.style.position = 'absolute';
     footer.style.bottom = '0';
   }
   else {
     footer.style.position = '';
     footer.style.bottom = '';
   }
 if (window.innerWidth<550) {
   /*document.getElementById("extralabels").style.display = 'table';
   document.getElementById("progressbar").style.height = '70%';*/
   document.getElementById("border").style.width = '100%';
   document.getElementsByClassName('labelleft')[0].style.display = 'none';
   document.getElementsByClassName('labelright')[0].style.display = 'none';
   document.getElementById('rightlabel').style.padding = '0px';
   document.getElementById('leftlabel').style.padding = '0px';
 }
 else {
   document.getElementById('rightlabel').style.padding = '5px  10px';
   document.getElementById('leftlabel').style.padding = '5px 10px';
 }
}

window.onload = footer();

function clicked(){
  var nav = document.getElementsByTagName("nav")[0];
  var btn = document.getElementById('menuButton');
  if(nav.style.display == "none"){
    nav.style.display = "block";
    btn.innerHTML = '&times';
    btn.style.fontSize = 'larger';
    footer();
  }
  else{
    nav.style.display = "none";
    btn.innerHTML = '☰';
    btn.style.fontSize = 'inherit';
    footer();
  }
  window.onclick = function(event) {
    var nav = document.getElementsByTagName("nav")[0];
    var btn = document.getElementById('menuButton');
    if (window.innerWidth < 751 && event.target.id !== 'menu' && event.target.id !== 'menuButton' && nav.style.display == 'block' && event.target.className !== 'box' && event.target.className !== 'profilmenu' && event.target.tagName !== 'A') {
        nav.style.display = 'none';
        btn.innerHTML = '☰';
        footer();
    }
  }
}
function starter() {
  document.getElementsByTagName("nav")[0].style.display = "none";
}
starter();
function homeHover() {
  home = document.getElementsByClassName("home")[0];
  home.setAttribute('src', 'Assets/p_home.png');
}
function homeUnhover() {
  var x = home.getAttribute("id");
  if(x == "active"){
    home.setAttribute('src', 'Assets/a_home.png');
  }else{
    home.setAttribute('src', 'Assets/home.png');
  }
}
function workHover() {
  work = document.getElementsByClassName("work")[0];
  work.setAttribute('src', 'Assets/p_work.png');

}
function workUnhover() {
    var x = work.getAttribute("id");
    if(x == "active"){
     work.setAttribute('src', 'Assets/a_work.png');
     }else{
     work.setAttribute('src', 'Assets/work.png');
     }
}
function moneyHover() {
  money = document.getElementsByClassName("money")[0]
  money.setAttribute('src', 'Assets/p_money.png');
}
function moneyUnhover(element) {
    var x = money.getAttribute("id");
    if(x == "active"){
      money.setAttribute('src', 'Assets/a_money.png');
    }else{
      money.setAttribute('src', 'Assets/money.png');
    }
}
function tabHover() {
  tab = document.getElementsByClassName("tab")[0];
  tab.setAttribute('src', 'Assets/p_tab.png');
}
function tabUnhover(element) {
    var x = tab.getAttribute("id");
    if(x == "active"){
      tab.setAttribute('src', 'Assets/a_tab.png');
    }else{
      tab.setAttribute('src', 'Assets/tab.png');
    }
}
function norHover() {
  tab = document.getElementsByClassName("nor")[0];
  tab.setAttribute('src', 'Assets/p_norway.png');
}
function norUnhover(element) {
    var x = tab.getAttribute("id");
    if(x == "active"){
      tab.setAttribute('src', 'Assets/a_norway.png');
    }else{
      tab.setAttribute('src', 'Assets/norway.png');
    }
}
function profileHover() {
  profile = document.getElementsByClassName("profile")[0];
  profile.setAttribute('src', 'Assets/p_profile.png');
  arrow = document.getElementById("arrow");
  arrow.setAttribute('src', 'Assets/p_dropdown.png');
}
function profileUnhover() {
    var x = profile.getAttribute("id");
    if(x == "active"){
     profile.setAttribute('src', 'Assets/a_profile.png');
  /*  if (window.innerWidth < 950 && window.innerWidth > 750) {
     arrow.setAttribute('src', 'Assets/a_dropdown.png');
   } else {*/
     arrow.setAttribute('src', 'Assets/dropdown.png');
   //}
     }
     else{
     profile.setAttribute('src', 'Assets/profile.png');
     arrow.setAttribute('src', 'Assets/dropdown.png');
     }
}

function logginn(){
  var modal = document.getElementById('myModal');
  modal.style.display = "block";
}
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];

function closeloginform(){
modal.style.display = "none";
}
window.onclick = function(event) {
if (event.target == modal) {
    modal.style.display = "none";
}
}
window.onload = footer();
