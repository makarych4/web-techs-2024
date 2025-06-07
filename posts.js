class Post {
    constructor() {
        this._postId = null;
        this._postTitle = null;
        this._postText = null;
        this._postComments = null;
    }

    get postId() {
        return this._postId;
    }

    set postId(id) {
        this._postId = id;
    }

    get postTitle() {
        return this._postTitle;
    }

    set postTitle(title) {
        this._postTitle = title;
    }

    get postText() {
        return this._postText;
    }

    set postText(text) {
        this._postText = text;
    }

    get postComments() {
        return this._postComments;
    }

    set postComments(comments) {
        this._postComments = comments;
    }

    restoreItemFromStorage() {
        const strPostObj = localStorage.getItem("postItem");
        const postObj = JSON.parse(strPostObj);
        return postObj;
    }

    async getPostComments() {
        try {
            const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${this.postId}/comments`);
            if (!response.ok) {
                console.error("HTTP error:", response.status);
                return [];
            }
            const comments = await response.json();
            return comments;
        } catch (err) {
            console.error("Fetch error:", err);
            return [];
        }
    }

    renderComments() {
        const commentSection = document.querySelector(".post__comments");
        this.postComments.forEach((comment) => {
            const html = `
                <hr/>
                <h3>Comment title: ${comment.name}</h3>
                <p>Comment text: ${comment.body}</p>
                <h4>User e-mail: ${comment.email}</h4>
            `;
            commentSection.insertAdjacentHTML('beforeend', html);
        });
    }

    renderPostItem() {
        document.querySelector(".post__title").textContent = this.postTitle;
        document.querySelector(".post__text").textContent = this.postText;
    }

    init() {
        const postItem = this.restoreItemFromStorage();
        this.postId = postItem.id;
        this.postTitle = postItem.title;
        this.postText = postItem.text;
    }
}

document.addEventListener('DOMContentLoaded', async function () {
    const post = new Post();
    post.init();

    generateURLRoute(post.postId);

    post.postComments = await post.getPostComments();
    console.log(post);

    post.renderPostItem();
    post.renderComments();

    if (post.postComments.length > 0) {
        console.log(post.postComments[0]);
    }
});

const generateURLRoute = (postId) => {
    const newHref = `/posts/${postId}`;
    window.history.pushState({}, "", newHref);
};
