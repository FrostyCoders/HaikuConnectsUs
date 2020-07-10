class Haiku 
{
    constructor(id, authorId, authorName, addTime, title, content, likes, likeStatus, font, textAlign, background, own, reported)
    {
        this.id = id;
        this.authorId = authorId;
        this.authorName
        this.addTime = addTime;
        this.title = title;
        this.content = content;
        this.likes = likes;
        this.likeStatus = likeStatus;
        this.textAlign = textAlign;
        this.background = background;
        this.own = own;
        this.reported = reported;
    }
    // DISPLAY HAIKU ON WEBSITE
    generate()
    {
        var posts = document.createElement("div");
        posts.setAttribute("id", "haiku"+this.id);
        posts.setAttribute("class", "posts");
        var posts_haiku = document.createElement("div");
        posts_haiku.setAttribute("class", "posts_haiku");
        posts_haiku.innerHTML = this.content;
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