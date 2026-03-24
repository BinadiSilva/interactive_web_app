document.addEventListener("DOMContentLoaded", function () {
  const currentUser =
    JSON.parse(localStorage.getItem("recipebook_current_user")) || null;

  const profileName = document.getElementById("profileName");
  const profileEmail = document.getElementById("profileEmail");
  const profileFullNameText = document.getElementById("profileFullNameText");
  const profileEmailText = document.getElementById("profileEmailText");
  const profileAddressText = document.getElementById("profileAddressText");
  const profilePhoneText = document.getElementById("profilePhoneText");
  const profilePhotoStatus = document.getElementById("profilePhotoStatus");
  const profileAvatarPreview = document.getElementById("profileAvatarPreview");
  const profilePhotoPreview = document.getElementById("profilePhotoPreview");
  const reviewsList = document.getElementById("reviewsGivenList");
  const recipesList = document.getElementById("addedRecipesList");
  const passwordMessage = document.getElementById("passwordMessage");

  if (!currentUser) {
    window.location.href = "login.php";
    return;
  }

  function showMessage(element, text, type) {
    if (!element) return;
    element.textContent = text;
    element.className = "form-message " + (type === "success" ? "success-text" : "error-text");
  }

  function loadProfileData() {
    if (profileName) profileName.textContent = currentUser.name || currentUser.username || "User Name";
    if (profileEmail) profileEmail.textContent = currentUser.email || "-";

    if (profileFullNameText) profileFullNameText.textContent = currentUser.name || currentUser.username || "-";
    if (profileEmailText) profileEmailText.textContent = currentUser.email || "-";
    if (profileAddressText) profileAddressText.textContent = currentUser.address || "-";
    if (profilePhoneText) profilePhoneText.textContent = currentUser.phone || "-";
    if (profilePhotoStatus) profilePhotoStatus.textContent = currentUser.photo ? "Added" : "Not added";

    if (currentUser.photo && currentUser.photo.trim() !== "") {
      if (profilePhotoPreview) {
        profilePhotoPreview.src = currentUser.photo;
        profilePhotoPreview.classList.remove("d-none");
      }
      if (profileAvatarPreview) {
        profileAvatarPreview.classList.add("d-none");
      }
    } else {
      if (profilePhotoPreview) {
        profilePhotoPreview.classList.add("d-none");
      }
      if (profileAvatarPreview) {
        profileAvatarPreview.classList.remove("d-none");
      }
    }
  }

  function updatePasswordInStorage(newPassword) {
    currentUser.password = newPassword;
    localStorage.setItem("recipebook_current_user", JSON.stringify(currentUser));

    const users = JSON.parse(localStorage.getItem("recipebook_users")) || [];
    const updatedUsers = users.map(function (user) {
      if (user.email === currentUser.email) {
        return { ...user, password: newPassword };
      }
      return user;
    });

    localStorage.setItem("recipebook_users", JSON.stringify(updatedUsers));
  }

  const changePasswordBtn = document.getElementById("changePasswordBtn");
  if (changePasswordBtn) {
    changePasswordBtn.addEventListener("click", function () {
      const newPassword = document.getElementById("newPassword").value.trim();
      const confirmPassword = document.getElementById("confirmPassword").value.trim();

      if (!newPassword || !confirmPassword) {
        showMessage(passwordMessage, "Please fill both password fields.", "error");
        return;
      }

      if (newPassword !== confirmPassword) {
        showMessage(passwordMessage, "Passwords do not match.", "error");
        return;
      }

      updatePasswordInStorage(newPassword);

      document.getElementById("newPassword").value = "";
      document.getElementById("confirmPassword").value = "";

      showMessage(passwordMessage, "Password changed successfully.", "success");
    });
  }

  const reviewKey = `userReviews_${currentUser.email}`;
  const recipeKey = `userRecipes_${currentUser.email}`;
  
  const userReviews = JSON.parse(localStorage.getItem(reviewKey)) || [];
  const userRecipes = JSON.parse(localStorage.getItem(recipeKey)) || [];

  if (reviewsList && userReviews.length > 0) {
    reviewsList.innerHTML = "";
    userReviews.forEach(function (review) {
      const li = document.createElement("li");
      li.className = "list-group-item";
      li.textContent = review;
      reviewsList.appendChild(li);
    });
  }

  if (recipesList && userRecipes.length > 0) {
    recipesList.innerHTML = "";
    userRecipes.forEach(function (recipe) {
      const li = document.createElement("li");
      li.className = "list-group-item";
      li.textContent = recipe;
      recipesList.appendChild(li);
    });
  }

  loadProfileData();
});