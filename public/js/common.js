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