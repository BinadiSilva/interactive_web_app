document.addEventListener("DOMContentLoaded", function () {
  const USERS_KEY = "recipebook_users";
  const CURRENT_USER_KEY = "recipebook_current_user";

  function getUsers() {
    return JSON.parse(localStorage.getItem(USERS_KEY)) || [];
  }

  function saveUsers(users) {
    localStorage.setItem(USERS_KEY, JSON.stringify(users));
  }

  function getCurrentUser() {
    return JSON.parse(localStorage.getItem(CURRENT_USER_KEY)) || null;
  }

  function setCurrentUser(user) {
    localStorage.setItem(CURRENT_USER_KEY, JSON.stringify(user));
  }

  function removeCurrentUser() {
    localStorage.removeItem(CURRENT_USER_KEY);
  }

  function showMessage(elementId, text, type) {
    const el = document.getElementById(elementId);
    if (!el) return;
    el.textContent = text;
    el.className = "form-message " + (type === "success" ? "success-text" : "error-text");
  }

  function updateNavbar() {
    const loginNav = document.getElementById("loginNav");
    const registerNav = document.getElementById("registerNav");
    const profileNav = document.getElementById("profileNav");
    const navUserName = document.getElementById("navUserName");
    const authOnlyLinks = document.querySelectorAll(".auth-only");
    const user = getCurrentUser();

    if (user) {
      if (loginNav) loginNav.classList.add("d-none");
      if (registerNav) registerNav.classList.add("d-none");
      authOnlyLinks.forEach(link => link.classList.remove("d-none"));
      if (profileNav) profileNav.classList.remove("d-none");
      if (navUserName) navUserName.textContent = user.name || "Profile";
    } else {
      if (loginNav) loginNav.classList.remove("d-none");
      if (registerNav) registerNav.classList.remove("d-none");
      authOnlyLinks.forEach(link => link.classList.add("d-none"));
      if (profileNav) profileNav.classList.add("d-none");
    }
  }

  function protectPage() {
    const isProtected = document.body.classList.contains("protected-page");
    if (isProtected && !getCurrentUser()) {
      window.location.href = "login.html";
    }
  }

  updateNavbar();
  protectPage();

  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const name = document.getElementById("regName").value.trim();
      const email = document.getElementById("regEmail").value.trim().toLowerCase();
      const address = document.getElementById("regAddress").value.trim();
      const phone = document.getElementById("regPhone").value.trim();
      const photo = document.getElementById("regPhoto").value.trim();
      const password = document.getElementById("regPassword").value.trim();

      if (!name || !email || !address || !phone || !password) {
        showMessage("registerMessage", "Please fill all required fields.", "error");
        return;
      }

      const users = getUsers();
      const existingUser = users.find(user => user.email === email);

      if (existingUser) {
        showMessage("registerMessage", "This email is already registered.", "error");
        return;
      }

      const newUser = {
        name: name,
        username: name,
        email: email,
        address: address,
        phone: phone,
        photo: photo,
        password: password
      };

      users.push(newUser);
      saveUsers(users);
      setCurrentUser(newUser);

      showMessage("registerMessage", "Registration successful. Redirecting to profile...", "success");

      setTimeout(() => {
        window.location.href = "profile.php";
      }, 1000);
    });
  }

  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("loginEmail").value.trim().toLowerCase();
      const password = document.getElementById("loginPassword").value.trim();

      if (!email || !password) {
        showMessage("loginMessage", "Please enter email and password.", "error");
        return;
      }

      const users = getUsers();
      const matchedUser = users.find(user => user.email === email && user.password === password);

      if (!matchedUser) {
        showMessage("loginMessage", "Invalid email or password.", "error");
        return;
      }

      setCurrentUser(matchedUser);
      showMessage("loginMessage", "Login successful. Redirecting to profile...", "success");

      setTimeout(() => {
        window.location.href = "profile.php";
      }, 1000);
    });
  }

  const logoutBtn = document.getElementById("logoutBtn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", function () {
      removeCurrentUser();
      window.location.href = "login.php";
    });
  }

  window.recipeBookAuth = {
    getCurrentUser
  };
});