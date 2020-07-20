class Haiku 
{
    constructor(id, authorName, authorCountry, title, content, contentNative, likes, likeStatus, background, handwriting, reported)
    {
        this.id = id;
        this.authorName = authorName;
        this.authorCountry = authorCountry;
        this.title = title;
        this.content = content;
        this.contentNative = contentNative;
        this.likes = likes;
        this.likeStatus = likeStatus;
        this.background = background;
        this.handwriting = handwriting;
        this.reported = reported;
    }
    // DISPLAY HAIKU ON WEBSITE
    generate()
    {
        this.post = document.createElement("div");
        this.post.setAttribute("id", "haiku"+this.id);
        this.post.setAttribute("class", "posts mg-posts");
        
        let postElements = [];

        let post_header = document.createElement("div");
        post_header.setAttribute("class", "post-header");
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

        const options = ["Handwriting", "Report"];

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
        let post_like_counter = document.createElement('span');
        post_like_counter.setAttribute("data-velue", this.likes);
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
            {
                optionsCon.style.display = "none";
            }
            else
            {
                optionsCon.style.display = "block";
                optionsCon.style.animation = "show-element 1s 1";
            }
        });
        
        const options = document.querySelectorAll("#haiku"+this.id+" .post-nav-sub-option");
        options[0].addEventListener("click", () => {
            const hwCon = document.querySelector("#haiku"+this.id+" .post-nav-handwriting");
            hwCon.style.display = "block";
            hwCon.style.animation = "show-element 1s 1";
        });

        document.querySelector("#haiku"+this.id+" .post-nav-handwriting-close").addEventListener("click", () => {
            document.querySelector("#haiku"+this.id+" .post-nav-handwriting").style.display = "none";
        });

        options[1].addEventListener("click", () => {
            reportHaiku(this.id);
        });

        if(this.contentNative != "NO")
        {
            document.querySelector("#haiku"+this.id+" .lang-switcher").addEventListener("click", () => {
                if(document.querySelector("#haiku"+this.id+" .language-value").checked == true)
                {
                    document.querySelector("#haiku"+this.id+" .post-haiku").innerHTML = this.contentNative;
                }
                else
                {
                    document.querySelector("#haiku"+this.id+" .post-haiku").innerHTML = this.content;
                }
            });
        }
    }
    
    // LIKE OR DISLIKE HAIKU, DEPENDS ON CURRENT LIKE STATUS
    likeOrdislike()
    {
        var db_change = new XMLHttpRequest;
        var result;
        if (db_change.readyState == 4 && db_change.status == 200) {
            result = JSON.parse(db_change.responseText);
        }
        db_change.open("POST", "../resources/haiku_like.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        switch(this.likeStatus)
        {
            case true:
            {
                request.send("like=false&hid="+this.id);
                break;
            }
            case false:
            {
                request.send("like=true&hid="+this.id);
                break;
            }
        }
        if(result[0] == true)
        {
            switch(this.likeStatus)
            {
                case true:
                {
                    this.likeStatus = false;
                    this.likes--;
                    this.refresh();
                    break;
                }
                case false:
                {
                    this.likeStatus = true;
                    this.likes++;
                    this.refresh();
                    break;
                }
            }
        }
        else
        {
            displayError($result[1]);
        }
    }

    // REPORT HAIKU
    report(email, reason, callback)
    {
        if(this.reported == true) 
            return "You have already reported this haiku!";
        else if (reason.length == 0)
            return "Report reason can't be empty!";
        else
        {
            const reportRequest = new XMLHttpRequest;
            reportRequest.onreadystatechange = () => {
                if (reportRequest.readyState == 4 && reportRequest.status == 200) {
                    const result = JSON.parse(reportRequest.responseText);
                    if(result[0] == true)
                    {
                        this.reported = true;
                    }
                    if(typeof callback === "function")
                    {
                        callback(result[1]);   
                    }
                }
            };
            reportRequest.open("POST", "../resources/haiku_report.php", true);
            reportRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            reportRequest.send("hid="+this.id+"&email="+email+"&reason="+reason);
        }
    }
}