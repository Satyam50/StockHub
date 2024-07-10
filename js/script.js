var sideBarIsOpen = true;

document.getElementById("togglebtn").addEventListener("click", (event) => {
  event.preventDefault();
  const dashboard_sidebar = document.getElementById("dashboard_sidebar");
  const dashboard_content_container = document.getElementById(
    "dashboard_content_container"
  );
  const dashboard_logo = document.getElementById("dashboard_logo");
  const userImage = document.getElementById("userImage");
  const menuTextElements = document.querySelectorAll(".menutext");

  if (sideBarIsOpen) {
    dashboard_sidebar.style.width = "5%";
    dashboard_content_container.style.width = "95%";
    dashboard_logo.style.fontSize = "1em";
    userImage.style.width = "30px";
    userImage.style.height = "30px";
    document.getElementById("username").style.display = "none";
    menuTextElements.forEach((menuText) => {
      menuText.style.display = "none";
    });
    sideBarIsOpen = false;
  } else {
    dashboard_sidebar.style.width = "20%";
    dashboard_content_container.style.width = "80%";
    dashboard_logo.style.fontSize = "1.5em";
    userImage.style.width = "60px";
    userImage.style.height = "60px";
    document.getElementById("username").style.display = "inline";
    menuTextElements.forEach((menuText) => {
      menuText.style.display = "inline";
    });
    sideBarIsOpen = true;
  }
});

