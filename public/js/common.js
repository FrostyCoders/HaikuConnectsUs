const Loading = (state) => {
    const container = document.getElementsByClassName("points-loading-container")[0];
    if(state == true)
    {
        container.style.display = "block";
    }
    else
    {
        container.style.display = "none";
    }
}

const checkArray = (array, value) => {
    if(Array.isArray(array) == false)
        return false;
    
    let found = false;
    array.forEach(element => {
        if(element == value)
            found = true;
    });
    return found;
};

function showCommunicate(message) {
    if(message[1].length == 0)
        return ;
    const box = document.getElementById("post-error");
    box.textContent = message[1];
    box.style.display = "block";
    new Promise((resolve, reject) => {
        if(message[0] == false)
            box.style.color = "red";
        else
            box.style.color = "var(--dark-color)";
        resolve();
    }).then(() => {
        if(message[0] == false)
        {
            box.animate([
                { transform: 'translateX(-45%)' },
                { transform: 'translateX(-55%)' },
                { transform: 'translateX(-50%)' }
            ], {
                duration: 100,
                iterations: 3
            });
        }
        else
        {
            box.animate([
                { top: "6rem" }, 
                { top: "6.5rem" }
            ], {
                duration: 300,
                iterations: 1
            });
        }
    }).then(() => {
        setTimeout(() => {
            box.style.display = "none";
        }, 5000);
    });
};