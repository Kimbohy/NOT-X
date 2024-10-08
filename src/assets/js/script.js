const commentSection = document.querySelector("#comment");
const commentForm = document.querySelector("#commentForm");

document.addEventListener("DOMContentLoaded", () => {
  renderPosts();
});

const accountId = localStorage.getItem("accountId") || "0";

const renderPosts = () => {
  const postContainer = document.querySelector("#postContainer"); // Select a specific container for posts
  fetch("http://localhost:8080/src/actions/getPosts.php")
    .then((response) => response.json()) // return the parsed JSON
    .then((data) => {
      // console.log(data);
      postContainer.innerHTML = ""; // Clear the container before appending new posts

      data.forEach((dt) => {
        const container = document.createElement("div");
        container.className = "p-3 bg-post rounded-xl";
        container.id = dt.postId;
        console.log(dt.postId);

        const head = document.createElement("div");
        head.className = "flex items-center justify-between";

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

        head.appendChild(userInfo);

        // console.log(dt.user.id, accountId);
        if (accountId == dt.user.id) {
          postSince.textContent += " (You)";
          const deleteButton = document.createElement("img");
          deleteButton.src = "./src/assets/icons/Circle-xmark.svg";
          deleteButton.alt = "delete";
          deleteButton.className = "h-6";
          deleteButton.onclick = () => {
            fetch("http://localhost:8080/src/actions/deletePost.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                postId: dt.postId, // Send the post ID to delete
              }),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data.message);
                // search for the post in the DOM and remove it
                const post = document.getElementById(dt.postId);
                post.remove();
              })
              .catch((error) => console.error("Error deleting post:", error));
          };
          head.appendChild(deleteButton);
        }

        const content = document.createElement("p");
        content.className = "p-5";
        content.textContent = dt.content;

        const reactions = document.createElement("div");
        reactions.className = "flex gap-2";

        const heartIcon = document.createElement("img");
        heartIcon.src = JSON.stringify(dt.reaction).includes(accountId)
          ? "./src/assets/icons/Heart2.svg"
          : "./src/assets/icons/Heart.svg";

        heartIcon.alt = "heart";
        heartIcon.className = "h-6";
        heartIcon.onclick = () => {
          const accountId = localStorage.getItem("accountId");

          fetch("http://localhost:8080/src/actions/reactPost.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              postId: dt.postId,
              accountId: accountId, // Send the accountId along with postId
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              console.log(data.message);
              heartIcon.src = data.reacted
                ? "./src/assets/icons/Heart2.svg" // If reacted, show filled heart
                : "./src/assets/icons/Heart.svg"; // If not reacted, show outline heart
            })
            .catch((error) => console.error("Error reacting to post:", error));
        };

        const messageIcon = document.createElement("img");
        messageIcon.src = "./src/assets/icons/Message square.svg";
        messageIcon.alt = "message";
        messageIcon.className = "h-6";
        messageIcon.onclick = () => {
          // console.log("Opening comment section");
          commentSection.classList.toggle("block");
          commentSection.classList.toggle("hidden");
          renderComments(dt.postId);

          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          commentForm.onsubmit = (event) => {
            event.preventDefault();
            const content = document.querySelector("#commentContent").value;
            fetch("http://localhost:8080/src/actions/addComment.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                content,
                postId: dt.postId,
              }),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data.success);
                renderComments(dt.postId); // need optimization
                document.querySelector("#commentContent").value = "";
              })
              .catch((error) =>
                console.error("Error creating comment:", error)
              );
          };
          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        };

        // Ensure the comment section is hidden by default
        commentSection.classList.add("hidden");

        reactions.appendChild(heartIcon);
        reactions.appendChild(messageIcon);

        container.appendChild(head);
        container.appendChild(content);
        container.appendChild(reactions);

        postContainer.appendChild(container); // Append posts to the container
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
};

const handleCreatePost = (event) => {
  event.preventDefault(); // Prevent the form from submitting normally

  const content = document.querySelector("#content").value;

  fetch("http://localhost:8080/src/actions/addPost.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json", // Inform the server you're sending JSON
    },
    body: JSON.stringify({
      content, // Send the content as JSON
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data.message);
      // Optionally: clear the textarea after successful post creation
      document.querySelector("#content").value = "";
      renderPosts(); // Re-render posts after successful creation
    })
    .catch((error) => console.error("Error creating post:", error));
};

const renderComments = (postId) => {
  const commentContainer = document.querySelector("#commentContainer");
  commentContainer.innerHTML = "";
  fetch("http://localhost:8080/src/actions/getComments.php?postId=" + postId)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      if (Array.isArray(data) && data.length > 0) {
        data.forEach((dt) => {
          const container = document.createElement("div");
          container.className = "p-3 bg-post rounded-xl";

          const head = document.createElement("div");
          head.className = "flex items-center justify-between";

          const userInfo = document.createElement("div");
          userInfo.className = "flex items-end gap-2";

          const profilePicture = document.createElement("img");
          profilePicture.src = dt.profilePicture;
          profilePicture.alt = "profilePicture";
          profilePicture.className = "h-10 rounded-full";

          const fullName = document.createElement("h2");
          fullName.className = "text-xl text-maron";
          fullName.textContent = dt.fullName;

          const postSince = document.createElement("p");
          postSince.className = "text-lg text-gris";
          postSince.textContent = dt.commentSince;
          userInfo.appendChild(profilePicture);
          userInfo.appendChild(fullName);
          userInfo.appendChild(postSince);
          head.appendChild(userInfo);
          const heartIcon = document.createElement("img");
          fetch(
            `http://localhost:8080/src/actions/getUserReacted.php?commentId=${dt.commentId}`
          )
            .then((response) => response.json())
            .then((data) => {
              // get the result and do the traitment
              heartIcon.src =
                data == true
                  ? "./src/assets/icons/Heart2.svg"
                  : "./src/assets/icons/Heart.svg";
            });

          heartIcon.alt = "heart";
          heartIcon.className = "h-6";
          heartIcon.onclick = () => {
            fetch("http://localhost:8080/src/actions/reactComment.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                commentId: dt.id,
              }),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data.message);
                heartIcon.src = data.reacted
                  ? "./src/assets/icons/Heart2.svg" // If reacted, show filled heart
                  : "./src/assets/icons/Heart.svg"; // If not reacted, show outline heart
              })
              .catch((error) =>
                console.error("Error reacting to post:", error)
              );
          };
          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

          const content = document.createElement("p");
          content.className = "p-5";
          content.textContent = dt.content;

          const body = document.createElement("div");
          body.className = "flex justify-between";
          body.appendChild(content);
          body.appendChild(heartIcon);

          container.appendChild(head);
          container.appendChild(body);

          commentContainer.appendChild(container);

          // console.log(container);
        });
      } else {
        console.log("No comments available");
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
};

const handleCreateComment = () => {};
