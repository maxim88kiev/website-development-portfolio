function openMenu(){document.getElementById("openMenuBtn").addEventListener("click",function(e){e.preventDefault,document.getElementById("menuElement").classList.add("active")},!1)}function closeMenu(){document.getElementById("closeMenuBtn").addEventListener("click",function(e){e.preventDefault,document.getElementById("menuElement").classList.remove("active")},!1)}document.addEventListener("DOMContentLoaded",openMenu),document.addEventListener("DOMContentLoaded",closeMenu);