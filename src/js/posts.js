document.addEventListener('DOMContentLoaded', () => {
    function chunkArray(array, size) {
        const chunkyArr = []
        let index = 0
        while (index < array.length) {
            chunkyArr.push(array.slice(index, size + index))
            index += size
        }
        return chunkyArr
    }

    const itemsContainer = document.querySelector(".posts__list"),
        button = document.querySelector(".posts__more"),
        postsShown = parseInt(customs_loadmore_params.postsPerPage)
    let allPosts = [],
        count = 0;

    (async () => {
        try {
            const response = await fetch(`${customs_loadmore_params.restURL}blog-posts/all-posts`);
            allPosts = await response.json()

            if (button && allPosts.length !== 0) {
                button.classList.remove("hide")

                button.addEventListener("click", () => {
                    let data = allPosts.slice();
                    data.splice(0, postsShown)
                    const newData = chunkArray(data, postsShown),
                        currentChunk = newData[count]

                    if (count <= newData.length) {
                        const items = []
                        currentChunk.forEach((key, index) => {
                            const postTitle = currentChunk[index]['title'],
                                postDate = currentChunk[index]['date'],
                                postExcerpt = currentChunk[index]['excerpt'],
                                postPermalink = currentChunk[index]['url'],
                                img = currentChunk[index]['img'],
                                article = `
                               <div class="posts__item-wrap fadeIn col-lg-3 col-md-4 col-sm-6 col-12">
                                    <a href="${postPermalink}" class="posts__item">
                                            ${img}
                                            <div class="posts__item-text">
                                              <time class="posts__date">${postDate}</time>
                                              <div class="posts__item__title">${postTitle}</div>
                                              <p>${postExcerpt}</p>
                                            </div>
                                        </a>
                                </div>
                                `
                            items.push(article)
                        })

                        itemsContainer.insertAdjacentHTML("beforeend", items.join(""))
                        if (++count === newData.length) button.classList.add("hide")
                    } else {
                        button.classList.add("hide")
                    }
                })
            }
        } catch (error) {
            console.error(error);
        }
    })()

}, false)
