class Haiku 
{
    constructor(id, authorName, authorCountry, content, contentNative, likes, likeStatus, background, handwriting, reported, gridClass, loggedIn)
    {
        this.id = id;
        this.authorName = authorName;
        this.authorCountry = authorCountry;
        this.content = content;
        this.contentNative = contentNative;
        this.likes = likes;
        this.likeStatus = likeStatus;
        this.background = background;
        this.handwriting = handwriting;
        this.reported = reported;
        this.gridClass = gridClass;
        this.loggedIn = loggedIn;
    }
    // DISPLAY HAIKU ON WEBSITE
    generate()
    {
        this.post = document.createElement("div");
        this.post.setAttribute("id", "haiku"+this.id);
        this.post.setAttribute("class", "posts " + this.gridClass);
        
        let postElements = [];

        let post_header = document.createElement("div");
        post_header.setAttribute("class", "post-header");
        post_header.setAttribute("style", "background-image: url('../uploads/background/" + this.background + "');");
        let posts_haiku = document.createElement("div");
        posts_haiku.setAttribute("class", "posts-haiku");
        let post_haiku = document.createElement("div");
        post_haiku.setAttribute("class", "post-haiku");
        post_haiku.innerHTML = this.content;
        posts_haiku.appendChild(post_haiku);
        post_header.appendChild(posts_haiku);
        postElements.push(post_header);

        if(this.contentNative != "NO")
        {
            let lang_switch = document.createElement("div");
            lang_switch.setAttribute("class", "lang-switch");
            let lang_switcher = document.createElement("label");
            lang_switcher.setAttribute("class", "lang-switcher");
            let lang_input = document.createElement("input");
            lang_input.setAttribute("type", "checkbox");
            lang_input.setAttribute("class", "language-value");
            let lang_slider = document.createElement("span");
            lang_slider.setAttribute("class", "lang-slider");
            lang_switcher.appendChild(lang_input);
            lang_switcher.appendChild(lang_slider);
            lang_switch.appendChild(lang_switcher);
            postElements.push(lang_switch);
        }

        let post_nav = document.createElement("div");
        post_nav.setAttribute("class", "post-nav");

        var post_nav_dot = document.createElement("div");
        post_nav_dot.setAttribute("class", "post-nav-dot");
        post_nav.appendChild(post_nav_dot);

        let post_nav_handwriting = document.createElement("div");
        post_nav_handwriting.setAttribute("class", "post-nav-handwriting");
        post_nav_handwriting.setAttribute("id", "post-nav-handwriting");
        post_nav_handwriting.setAttribute("style", "background-image: url(../uploads/handwriting/"+ this.handwriting +")");
        let post_nav_handwriting_close = document.createElement("div");
        post_nav_handwriting_close.setAttribute("class", "post-nav-handwriting-close");
        post_nav_handwriting_close.setAttribute("id", "post-nav-handwriting-close");
        post_nav_handwriting.appendChild(post_nav_handwriting_close);
        post_nav.appendChild(post_nav_handwriting);

        var post_nav_sub = document.createElement("div");
        post_nav_sub.setAttribute("class", "post-nav-sub");

        let options = [];

        if(this.loggedIn == true)
        {
            options.push("Edit");
            
            if(this.handwriting != "no_hw.jpg")
                options.push("Handwriting");

            options.push("Delete");
        }
        else
        {
            options.push("Report");
            
            if(this.handwriting != "no_hw.jpg")
                options.push("Handwriting");
        }
        
        options.forEach(option => {
            let post_nav_sub_option = document.createElement("div");
            post_nav_sub_option.setAttribute("class", "post-nav-sub-option");
            post_nav_sub_option.textContent = option;
            post_nav_sub.appendChild(post_nav_sub_option);
        });

        post_nav.appendChild(post_nav_sub);

        postElements.push(post_nav);

        let post_footer = document.createElement('div');
        post_footer.setAttribute("class", "post-footer");

        let post_author = document.createElement('div');
        post_author.setAttribute("class", "post-author");
        post_author.textContent = this.authorName;
        post_footer.appendChild(post_author);

        let post_country = document.createElement('div');
        post_country.setAttribute("class", "post-country");
        post_country.textContent = this.authorCountry;
        post_footer.appendChild(post_country);

        let post_like = document.createElement('div');
        post_like.setAttribute("class", "post-like");
        if(this.likeStatus == true)
            post_like.style.backgroundImage = "url('img/icons/heart_full_normal.svg')";

        let post_like_counter = document.createElement('span');
        post_like_counter.textContent = this.likes;
        post_like.appendChild(post_like_counter);
        post_footer.appendChild(post_like);

        postElements.push(post_footer);

        postElements.forEach(element => {
            this.post.appendChild(element);
        });
    }
    showOnWebsite(boxId)
    {
        document.getElementById(boxId).appendChild(this.post);
        
        document.querySelector("#haiku"+this.id+" .post-nav").addEventListener("click", () => {
            const optionsCon = document.querySelector("#haiku"+this.id+" .post-nav-sub");
            if(optionsCon.style.display === "block")
                optionsCon.style.display = "none";
            else
            {
                optionsCon.style.display = "block";
                optionsCon.style.animation = "show-element 1s 1";
            }
        });
        
        const options = document.querySelectorAll("#haiku"+this.id+" .post-nav-sub-option");
        
        if(this.handwriting != "no_hw.jpg")
        {
            options[1].addEventListener("click", () => {
                const hwCon = document.querySelector("#haiku"+this.id+" .post-nav-handwriting");
                hwCon.style.display = "block";
                hwCon.style.animation = "show-element 1s 1";
            });
    
            document.querySelector("#haiku"+this.id+" .post-nav-handwriting-close").addEventListener("click", () => {
                document.querySelector("#haiku"+this.id+" .post-nav-handwriting").style.display = "none";
            });
        }

        if(this.loggedIn == true)
        {
            options[0].addEventListener("click", () => {
                this.editHaiku();
            });

            if(this.handwriting != "no_hw.jpg")
            {
                options[2].addEventListener("click", () => {
                    this.deleteHaiku();
                });
            }
            else
            {
                options[1].addEventListener("click", () => {
                    this.deleteHaiku();
                });
            }
            
        }
        else
        {
            options[0].addEventListener("click", () => {
                showReportHaiku(this.id);
            });
        }
        

        if(this.contentNative != "NO")
        {
            document.querySelector("#haiku"+this.id+" .lang-switcher").addEventListener("click", () => {
                if(document.querySelector("#haiku"+this.id+" .language-value").checked == true)
                    document.querySelector("#haiku"+this.id+" .post-haiku").innerHTML = this.contentNative;
                else
                    document.querySelector("#haiku"+this.id+" .post-haiku").innerHTML = this.content;
            });
        }

        document.querySelector("#haiku" + this.id + " .post-like").addEventListener("click", () => {
            this.likeOrdislike();
        });
    }
    
    // LIKE OR DISLIKE HAIKU, DEPENDS ON CURRENT LIKE STATUS
    likeOrdislike()
    {
        const dbChange = new XMLHttpRequest;
        dbChange.onreadystatechange = () => {
            if (dbChange.readyState == 4 && dbChange.status == 200) {
                const result = JSON.parse(dbChange.responseText);
                if(result[0] == true)
                {
                    const icon = document.querySelector("#haiku"+this.id+" .post-like");
                    switch(this.likeStatus)
                    {
                        case true:
                        {
                            this.likeStatus = false;
                            this.likes--;
                            icon.style.backgroundImage = "url('img/icons/heart_normal.svg')";
                            saveLikesData(this.id, "remove");
                            break;
                        }
                        case false:
                        {
                            this.likeStatus = true;
                            this.likes++;
                            icon.style.backgroundImage = "url('img/icons/heart_full_normal.svg')";
                            saveLikesData(this.id, "add");
                            break;
                        }
                    }
                    document.querySelector("#haiku"+this.id+" .post-like span").textContent = this.likes;
                }
                showCommunicate(result);
            }
        };
        dbChange.open("POST", "../resources/haiku_like.php", true);
        dbChange.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if(this.likeStatus == true)
            dbChange.send("like=false&hid="+this.id);
        else
            dbChange.send("like=true&hid="+this.id);
    }

    // REPORT HAIKU
    report(email, reason, callback)
    {
        if(this.reported == true) 
            callback([false, "Error, you have already reported this haiku!"]);
        else if (reason.length == 0)
            callback([false, "Error, report reason can't be empty!"]);
        else
        {
            const reportRequest = new XMLHttpRequest;
            reportRequest.onreadystatechange = () => {
                if (reportRequest.readyState == 4 && reportRequest.status == 200) {
                    const result = JSON.parse(reportRequest.responseText);
                    if(result[0] == true)
                    {
                        this.reported = true;
                        saveReportsData(this.id);
                    }
                    if(typeof callback === "function")
                        callback(result);
                }
            };
            reportRequest.open("POST", "../resources/haiku_report.php", true);
            reportRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            reportRequest.send("hid="+this.id+"&email="+email+"&reason="+reason);
        }
    }

    editHaiku()
    {
        sessionStorage.setItem("toEdit", this.id);
        window.location.href = "haiku_editor.php";
    }

    deleteHaiku()
    {
        if(confirm("Are you sure, this operation will delete haiku and reports related to it pernamently!"))
        {
            Loading(true);
            const request = new XMLHttpRequest;

            request.onreadystatechange = () => {
                if(request.readyState == 4 && request.status == 200)
                {
                    const response = JSON.parse(request.responseText);
                    if(response[0] == true)
                    {
                        if(haikuPosts.length <= 1)
                            loadHaiku(currentPage, order, ammount, selectedAuthor);
                        else
                            this.destroyPost();
                            
                        saveLikesData(this.id, "remove");
                    }
                    showCommunicate(response);
                    Loading(false);
                }
            };

            request.open("POST", "../resources/haiku_delete.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("haiku_id="+this.id);
        }
    }

    destroyPost()
    {
        this.post.remove();
    }
}