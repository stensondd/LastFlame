    var width  = window.innerWidth || document.documentElement.clientWidth || 
    document.body.clientWidth;
    var height = window.innerHeight|| document.documentElement.clientHeight|| 
    document.body.clientHeight;
    
    //radius of orbit
    const orbit = [150, 300, 400];
    var flameWidth = .1*1920;
    var widthChange = 1920/50;
    var flameHeight = .1*1080;
    var heightChange = 1080/50;

    stat = [6];
    //[Number, SplitNumber, Nudge]
    const constellation = [[6, 12, .5, 0], [12, 12, 0, 1], [12, 12, .5, 2]]
    //const constNames = [['Vit', 'End', 'Fin', 'Ins', 'Wit', 'Res'], [], []]
    const constNames = [['Vitality', 'Endurance', 'Finesse', 'Instinct', 'Wit', 'Resolve'], [], []]
    star = [];
    circle = [];
    stat = [];
    var splitPos = 0;
    function nursery(constell, name)
    {
        for(stell = 0; stell <constell[0]; stell+=(1))
        {
            stellar = stell+constell[2];
            split = (2*Math.PI/constell[0])*stellar;
            splitPos = split;
            star[stell] = document.createElement('div');
            star[stell].classList.add('dot');
            //star[stell].classList.add('hidden');
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
            stat[stell] = document.createElement('h1');
            stat[stell].innerHTML = '10';
            stat[stell].classList.add('stat');
            stat[stell].style.left = '50%';
            stat[stell].style.top = '50%';
            
            title = document.createElement('div');
            title.innerHTML = name[stell] ?? '';
            title.style.textAlign = 'center';
            title.style.display = 'flex';
            title.style.justifyContent = 'center';
            title.style.marginTop = -0;  

            stat[stell].appendChild(title);
            circle[stell].appendChild(stat[stell]);
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
            nursery(constellation[cluster], constNames[cluster]);
    }
    function shrink()
    {
        flameWidth += widthChange;
        flameHeight += heightChange;
        document.getElementById("flame").style.height = flameHeight+"px";
        document.getElementById("flame").style.width = flameWidth+"px ";
        document.getElementById("flame").style.top = '50%';
        document.getElementById("flame").style.left = '50%';
        document.getElementById("flame").style.marginTop = -flameHeight/2+"px";
        document.getElementById("flame").style.marginLeft = -flameWidth/2+"px ";
    }
    function expand(num)
    {
        var ele = document.getElementsByClassName("option")[num];
        ele.classList.remove('optionClose');
        ele.classList.add('optionExpand');
        buttonList();
    }
    function reduce(num)
    {
        var ele = document.getElementsByClassName("option")[num];
        ele.classList.remove('optionExpand');
        ele.classList.add('optionClose');
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
    shrink();
    document.getElementById('flame').addEventListener('click', function()
    {
        shrink();
    });
    document.getElementById('stat0').addEventListener('mouseover', function()
    {
        expand(0);
    });
    document.getElementById('option0').addEventListener('mouseleave', function()
    {
        reduce(0);
    });