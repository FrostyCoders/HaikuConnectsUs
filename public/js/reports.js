class report
{
    constructor(id, email, hid, reason, solved, time)
    {
        this.id = parseInt(id);
        this.solved = solved;
        this.referenceHaiku = hid;
        this.generateReport(email, reason, time);
    }

    generateReport(email, reason, time)
    {
        this.element = document.createElement("div");
        this.element.setAttribute("class", "report-container");
        this.element.setAttribute("id", "report" + this.id);

        this.element.innerHTML = '<div class="report-sender"><span>Sender: </span>' + email + '</div>';
        this.element.innerHTML += '<hr>';
        this.element.innerHTML += '<div class="report-desc"><span>Report: </span>' + reason + '</div>';
        this.element.innerHTML += '<div class="report-time">' + time + '</div>';

        let checkButton = document.createElement("div");
        checkButton.setAttribute("class", "report-to-haiku");
        checkButton.textContent = "Check haiku";
        checkButton.addEventListener("click", () => {
            this.goToHaiku();
        }, true);
        this.element.appendChild(checkButton);

        let doneSwitch = document.createElement("div");
        doneSwitch.setAttribute("class", "report-switch");
        let doneSwitcher = document.createElement("label");
        doneSwitcher.setAttribute("class", "report-switcher");
        let checkbox = document.createElement("input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("class", "report-value");
        if(this.solved == 1)
            checkbox.checked = true;
        else
            checkbox.checked = false;

        checkbox.addEventListener("change", () => {
            this.setState();
        }, true);

        let slider = document.createElement("span");
        slider.setAttribute("class", "report-slider");

        doneSwitcher.appendChild(checkbox);
        doneSwitcher.appendChild(slider);
        doneSwitch.appendChild(doneSwitcher);
        
        this.element.appendChild(doneSwitch);
    }

    getId()
    {
        return this.id;
    }

    showReport()
    {
        return this.element;
    }

    setState()
    {
        let newValue;
        if(this.solved == 1)
            newValue = 0;
        else
            newValue = 1;

        let id = this.id;

        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if(request.readyState == 4 && request.status == 200)
            {
                let response = JSON.parse(request.responseText);
                if(response[0] == false)
                {
                    showCommunicate(response);
                    const checkbox = document.querySelector("#report" + this.id + " .report-value");
                    if(this.solved == 1)
                        checkbox.checked = true;
                    else
                        checkbox.checked = false;
                        
                }   
                else
                    this.solved = newValue;
            }
        };

        request.open("POST", "../resources/reports_state.php", true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(
            "state="+newValue+"&"+
            "id="+id
        );
    }

    goToHaiku()
    {
        sessionStorage.setItem("toEdit", this.referenceHaiku);
        window.location.href = "haiku_editor.php";
    }
}

class reportsSite
{
    constructor(order, solved, page)
    {
        this.order = order;
        this.solved = solved;
        this.page = page;
    }

    reports = [];

    getReports()
    {
        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if(request.readyState == 4 && request.status == 200)
            {
                let response = JSON.parse(request.responseText);
                this.reports = [];
                if(response != false && response[0] == true)
                {
                    this.pages = response[1];
                    response[2].forEach(data => {
                        this.reports.push(new report(data['id'], data['email'], data['hid'], data['reason'], data['solved'], data['time']));
                    });
                }
                else if(response != false && response[0] == false)
                    showCommunicate(response);
                else
                    showCommunicate([false, "Error, something went wrong, try later!"]);

                this.displayReports();
                this.displayPages();
            }
        };

        request.open("POST", "../resources/reports_load.php", true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(
            "page="+this.page+"&"+
            "order="+this.order+"&"+
            "done="+this.solved
        );
    }

    displayReports()
    {
        let container = document.getElementsByClassName("report-content")[0];
        container.innerHTML = "";
        this.reports.forEach(element => {
            container.appendChild(element.showReport());
        });
    }

    initPages()
    {
        const previous = document.getElementById("previous_button");
        const next = document.getElementById("next_button");

        previous.addEventListener("click", () => {
            this.changePage(false);
        });

        next.addEventListener("click", () => {
            this.changePage(true);
        });
    }

    displayPages()
    {
        const previous = document.getElementById("previous_button");
        const pageNumber = document.querySelector("#page_number .page-link");
        const next = document.getElementById("next_button");

        pageNumber.textContent = this.page + "/" + this.pages;

        if(this.page > 1)
            previous.style.display = "block";
        else
            previous.style.display = "none";

        if(this.page < this.pages)
            next.style.display = "block";
        else
            next.style.display = "none";
    }

    changePage(where)
    {
        if(where == false && this.page > 1)
            this.page--;
        else if(where == true && this.page < this.pages)
            this.page++;
        else
            showCommunicate([false, "Error during page change, try later!"]);

        document.getElementsByClassName("filters-form")[0].scrollIntoView({behavior: 'smooth', block: 'start'});
        this.getReports();
    }

    changeFilters()
    {
        const sortInputs = document.getElementsByName("sort");
        const doneInputs = document.getElementsByName("done");
        sortInputs.forEach(element => {
            if(element.checked == true)
                this.order = element.value;
        });

        doneInputs.forEach(element => {
            if(element.checked == true)
                this.solved = element.value;
        });

        this.page = 1;
        this.getReports();
    }
}

window.onload = () => {
    window.site = new reportsSite("latest", 0, 1);
    site.getReports();
    site.displayReports();
    site.initPages();

    const inputs = document.querySelectorAll(".filters-form input");
    inputs.forEach(input => {
        input.addEventListener("change", () => {
            site.changeFilters();
        });
    });
};

