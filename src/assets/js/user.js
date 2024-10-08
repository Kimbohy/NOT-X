document.addEventListener("DOMContentLoaded", function () {
  // Get the user data from the local storage
  const user = JSON.parse(localStorage.getItem("accountId"));
  fetch(`http://localhost:8080/src/actions/session/userData.php?user=${user}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      document.querySelector(".profile-picture").src =
        "../../" + data.profilePicture;
      document.querySelector(
        ".profile-name"
      ).textContent = `${data.firstName} ${data.lastName}`;
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
      document.querySelector(".profile-name").textContent =
        "Error loading user data";
    });
});

const handleLogout = () => {
  localStorage.removeItem("accountId");
  window.location.href = "http://localhost:8080/src/actions/session/logout.php";
};
