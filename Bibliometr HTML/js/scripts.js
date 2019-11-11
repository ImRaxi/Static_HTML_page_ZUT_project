function panelToggle() {
    var panel = document.getElementById("panel");
    if (panel.style.display == "flex") {
        panel.style.display = "none";
    } else {
      panel.style.display = "flex";
    }
  }