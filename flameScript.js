    var width  = window.innerWidth || document.documentElement.clientWidth || 
    document.body.clientWidth;
    var height = window.innerHeight|| document.documentElement.clientHeight|| 
    document.body.clientHeight;
    
    //radius of orbit
    const orbit = [300, 500, 700];

    stat = [6];
    //[Number, SplitNumber, Nudge]
    const constellation = [[6, 12, .5, 0], [12, 12, 0, 1], [12, 12, .5, 2]]
    star = [];
    circle = [];
    var splitPos = 0;
    function nursery(constell)
    {
        for(stell = 0; stell <constell[0]; stell+=(1))
        {
            stellar = stell+constell[2];
            split = (2*Math.PI/constell[0])*stellar;
            splitPos = split;
            star[stell] = document.createElement('div');
            star[stell].classList.add('dot');
            star[stell].classList.add('hidden');
            star[stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            star[stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            circle[stell] = document.createElement('div');
            circle[stell].classList.add('node')
            circle[stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            circle[stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            circle[stell].addEventListener("click", (e) =>
            {
                nova(stell);
            })
            night.appendChild(star[stell]);
            night.appendChild(circle[stell]);
        }
    }

    function nova(stellarNum)
    {
        star[stellarNum].classList.remove('hidden');
    }
    function nebula()
    {
        night = document.getElementById('night');
        for(var cluster = 0; cluster < constellation.length; cluster++)
            nursery(constellation[cluster]);
    }

   function gravity()
    { 
        width  = window.innerWidth || document.documentElement.clientWidth || 
        document.body.clientWidth;
        height = window.innerHeight|| document.documentElement.clientHeight|| 
        document.body.clientHeight;
        for(var cluster = 0; cluster < constellation.length; cluster++)
            align(constellation[cluster]);
    }
    function align(constell)
    {
        for(stell = 0; stell <constell[0]; stell+=(1))
        {
            split = (2*Math.PI/constell[0])*(stell+constell[2]);
            splitPos = split;
            star[stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            star[stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            circle[stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            circle[stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
        }
    }
    window.onload = nebula();
    window.onresize = gravity();
    window.addEventListener('resize', function(event){
        gravity()
    });