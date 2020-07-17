class Haiku 
{
    constructor(id, authorName, authorCountry, title, content, contentNative, likes, likeStatus, background, reported)
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
        this.reported = reported;
    }
    // DISPLAY HAIKU ON WEBSITE
    generate()
    {
        var posts = document.createElement("div");
        posts.setAttribute("id", "haiku"+this.id);
        posts.setAttribute("class", "posts");
        
        var post_header = document.createElement("div");
        post_header.setAttribute("class", "post-header");
        var posts_haiku = document.createElement("div");
        posts_haiku.setAttribute("class", "posts-haiku");
        var post_haiku = document.createElement("div");
        post_haiku.setAttribute("class", "post-haiku");
        post_haiku.innerHTML = this.content;
        
        var lang_switch = document.createElement("div");
        lang_switch.setAttribute("class", "lang-switch");
        var lang_switcher = document.createElement("label");
        lang_switcher.setAttribute("class", "lang-switcher");
        var lang_input = document.createElement("input");
        lang_input.setAttribute("type", "checkbox");
        var lang_slider = document.createElement("span");
        lang_slider.setAttribute("class", "lang-slider");
        
        var post_nav_handwriting = document.createElement("div");
        post_nav_handwriting.setAttribute("class", "post-nav-handwriting");
        post_nav_handwriting.setAttribute("id", "post-nav-handwriting");
        var post_nav_handwriting_close = document.createElement("div");
        post_nav_handwriting_close.setAttribute("class", "post-nav-handwriting-close");
        post_nav_handwriting_close.setAttribute("id", "post-nav-handwriting-close");
        
        var post_nav = document.createElement("div");
        post_nav.setAttribute("id", "post-nav"+this.id);
        post_nav.setAttribute("class", "post-nav");
        var post_nav_dot = document.createElement("div");
        post_nav_dot.setAttribute("class", "post-nav-dot");
        var post_nav_sub = document.createElement("div");
        post_nav_sub.setAttribute("id", "post-nav-sub"+this.id);
        post_nav_sub.setAttribute("class", "post-nav-sub");
        var post_nav_sub_option1 = document.createElement("div");
        post_nav_sub_option1.setAttribute("id", "post-nav-sub-option-handwriting"+this.id);
        post_nav_sub_option1.setAttribute("class", "post-nav-sub-option");
        post_nav_sub_option1.textContent = "Handwriting";
        var post_nav_sub_option2 = document.createElement("div");
        post_nav_sub_option1.setAttribute("id", "post-nav-sub-option-report"+this.id);
        post_nav_sub_option1.setAttribute("class", "post-nav-sub-option");
        post_nav_sub_option1.textContent = "Report";
        var post_nav_sub_option3 = document.createElement("div");
        post_nav_sub_option2.setAttribute("id", "post-nav-sub-option-edit"+this.id);
        post_nav_sub_option2.setAttribute("class", "post-nav-sub-option");
        post_nav_sub_option2.textContent = "Edit";
        var post_nav_sub_option4 = document.createElement("div");
        post_nav_sub_option3.setAttribute("id", "post-nav-sub-option-delete"+this.id);
        post_nav_sub_option3.setAttribute("class", "post-nav-sub-option");
        post_nav_sub_option3.textContent = "Delete";
        
        var post_footer = document.createElement("div");
        post_footer.setAttribute("class", "post-footer");
        var post_author = document.createElement("div");
        post_author.setAttribute("class", "post-author");
        post_author.textContent = this.authorName;
        var post_country = document.createElement("div");
        post_country.setAttribute("class", "post-country");
        post_country.textContent = this.authorCountry;
        var post_like = document.createElement("div");
        post_like.setAttribute("id", "post-like"+this.id);
        post_like.setAttribute("class", "post-like");
        var post_like_counter = document.createElement("span");
        post_like_counter.setAttribute("id", "post-like-counter"+this.id);
        post_like_counter.textContent = this.likes;
        
        var post_error = document.createElement("div");
        post_error.setAttribute("class", "post-error");
        post_error.setAttribute("id", "post-error"+this.id);
        post_error.textContent = "Something gone wrong...";
        
        var post_report_menu = document.createElement("div");
        post_report_menu.setAttribute("class", "post-report-menu");
        post_report_menu.setAttribute("id", "post-report-menu"+this.id);
        var post_report_close = document.createElement("div");
        post_report_close.setAttribute("class", "post-report-close");
        post_report_close.setAttribute("id", "post-report-close"+this.id);
        var post_report_p = document.createElement("p");
        post_report_p.textContent = "Report an error:";
        var post_report_text = document.createElement("textarea");
        post_report_text.setAttribute("name", "text-report");
        post_report_text.setAttribute("placeholder", "Write why you are reporting this haiku...");
        var post_report_label = document.createElement("label");
        var post_report_email = document.createElement("input");
        post_report_email.setAttribute("type", "email");
        post_report_email.setAttribute("placeholder", "Must have to send");
        var post_report_input = document.createElement("input");
        post_report_input.setAttribute("type", "submit");
        post_report_input.setAttribute("value", "Send");
        
        posts.appendChild(post_header);
        post_header.appendChild(posts_haiku);
        posts_haiku.appendChild(post_haiku);
        
        posts.appendChild(lang_switch);
        lang_switch.appendChild(lang_switcher);
        lang_switcher.appendChild(lang_input);
        lang_switcher.appendChild(lang_slider);
        
        posts.appendChild(post_nav);
        post_nav.appendChild(post_nav_dot);
        post_nav.appendChild(post_nav_handwriting);
        post_nav_handwriting.appendChild(post_nav_handwriting_close);
        post_nav.appendChild(post_nav_sub);
        post_nav_sub.appendChild(post_nav_sub_option1);
        post_nav_sub.appendChild(post_nav_sub_option2);
        post_nav_sub.appendChild(post_nav_sub_option3);
        post_nav_sub.appendChild(post_nav_sub_option4);
        
        posts.appendChild(post_footer);
        post_footer.appendChild(post_author);
        post_footer.appendChild(post_country);
        post_footer.appendChild(post_like);
        post_like.appendChild(post_like_counter);
        
        post_report_menu.appendChild(post_report_close);
        post_report_menu.appendChild(post_report_p);
        post_report_menu.appendChild(post_report_text);
        post_report_menu.appendChild(post_report_label);
        post_report_menu.appendChild(post_report_email);
        post_report_menu.appendChild(post_report_input);
    }
    
    // SUBMENU IN HAIKU POSTS
    postSubMenu()
    {
        var postnavsub = document.getElementById("post-nav-sub"+this.id);

        if(postnavsub.style.display === "block")
            {
                postnavsub.style.display = "none";
            }
        else
            {
                postnavsub.style.display = "block";
                postnavsub.style.animation = "show-element 1s 1";
            }
    }

    var postnav = document.getElementById("post-nav"+this.id);
    postnav.addEventListener('click', postSubMenu, false);
    
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
    
    likeIt()
    {
        var like = document.getElementById("post-like"+this.id);

         switch(this.likeStatus)
        {
            case true:
            {
                like.style.backgroundImage = "url('img/icons/heart_full_normal.svg')";
                like.style.animation = "like-it 1s 1";
                break;
            }
            case false:
            {
                like.style.backgroundImage = "url('img/icons/heart_normal.svg')";
                like.style.animation = "like-it 1s 1";
                break;
            }
        }
    }

    var like = document.getElementById("post-like"+this.id);
    like.addEventListener('click', likeIt, false);

    // REPORT HAIKU
    report(reason)
    {
        if(this.reported == true)
        {
            var result = "You have already reported this haiku!";
        }
        else
        {
            var reportRequest = new XMLHttpRequest;
            if (reportRequest.readyState == 4 && reportRequest.status == 200) {
                var result = JSON.parse(reportRequest.responseText);
            }
            reportRequest.open("POST", "../resources/haiku_report.php", true);
            reportRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            reportRequest.send("hid="+this.id+"&reason="+reason);
            if(result[0] == true)
            {
                this.reported = true;
            }
            this.refresh();
        }
    }
}