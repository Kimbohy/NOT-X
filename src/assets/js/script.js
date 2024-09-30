document.addEventListener("DOMContentLoaded", () => {
  renderPosts();
});

const accountId = localStorage.getItem("accountId") || "1";

const renderPosts = () => {
  fetch("http://localhost:8080/src/actions/getPosts.php")
    .then((response) => response.json()) // return the parsed JSON
    .then((data) => {
      // console.log(data);
      const postContainer = document.querySelector("#postContainer"); // Select a specific container for posts

      data.forEach((dt) => {
        const container = document.createElement("div");
        container.className = "p-3 bg-post rounded-xl";

        const userInfo = document.createElement("div");
        userInfo.className = "flex items-end gap-2";

        const profilePicture = document.createElement("img");
        profilePicture.src = dt.user.profilePicture;
        profilePicture.alt = "profilePicture";
        profilePicture.className = "h-10 rounded-full";

        const fullName = document.createElement("h2");
        fullName.className = "text-xl text-maron";
        fullName.textContent = dt.user.fullName;

        const postSince = document.createElement("p");
        postSince.className = "text-lg text-gris";
        postSince.textContent = dt.postSince;

        userInfo.appendChild(profilePicture);
        userInfo.appendChild(fullName);
        userInfo.appendChild(postSince);

        const content = document.createElement("p");
        content.className = "p-5";
        content.textContent = dt.content;

        const reactions = document.createElement("div");
        reactions.className = "flex gap-2";

        const heartIcon = document.createElement("img");
        heartIcon.src = dt.reaction.includes(accountId)
          ? "./src/assets/icons/Heart.svg"
          : "./src/assets/icons/Heart2.svg";
        heartIcon.alt = "heart";
        heartIcon.className = "h-6";

        const messageIcon = document.createElement("img");
        messageIcon.src = "./src/assets/icons/Message square.svg";
        messageIcon.alt = "message";
        messageIcon.className = "h-6";

        reactions.appendChild(heartIcon);
        reactions.appendChild(messageIcon);

        container.appendChild(userInfo);
        container.appendChild(content);
        container.appendChild(reactions);

        postContainer.appendChild(container); // Append posts to the container
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
};
