class report
{
    constructor(data)
    {
        this.id = data['id'];
        this.element = document.createElement("div");
        this.element.setAttribute("class", "report-container");
        this.element.setAttribute("id", "report" + data["id"]);

        this.element.innerHTML = '<div class="report-sender"><span>Sender: </span>' + data["email"] + '</div>';
        this.element.innerHTML += '<hr>';
        this.element.innerHTML += '<div class="report-desc"><span>Report: </span>' + data['reason'] + '</div>';
        this.element.innerHTML += '<div class="report-time">' + data['time'] + '</div>';

        let checkButton = document.createElement("div");
        checkButton.setAttribute("class", "report-to-haiku");
        checkButton.textContent = "Check haiku";
        checkButton.addEventListener("click", this.goToHaiku, true);
        this.element.appendChild(checkButton);

        let doneSwitch = document.createElement("div");
        doneSwitch.setAttribute("class", "report-switch");
        let doneSwitcher = document.createElement("label");
        doneSwitcher.setAttribute("class", "report-switcher");
        let checkbox = document.createElement("input");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("class", "report-value");
        if(data['solved'] == "1")
            checkbox.checked = true;
        else
            checkbox.checked = false;

        checkbox.addEventListener("change", this.setState, true);

        let slider = document.createElement("span");
        slider.setAttribute("class", "report-slider");

        doneSwitcher.appendChild(checkbox);
        doneSwitcher.appendChild(slider);
        doneSwitch.appendChild(doneSwitcher);
        
        this.element.appendChild(doneSwitch);

        report.referenceHaiku = data['hid'];
    }

    showReport()
    {
        return this.element;
    }

    goToHaiku()
    {
        sessionStorage.setItem("toEdit", report.referenceHaiku);
        window.location.href = "haiku_editor.php";
    }

    setState()
    {
        
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
                        this.reports.push(new report(data));
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

    displayPages()
    {
        
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

        this.getReports();
    }
}

window.onload = () => {
    const site = new reportsSite("latest", "0", 1);
    site.getReports();
    site.displayReports();

    const inputs = document.querySelectorAll(".filters-form input");
    inputs.forEach(input => {
        input.addEventListener("click", () => {
            site.changeFilters();
        });
    });
};



