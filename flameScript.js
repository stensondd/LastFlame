    var width  = window.innerWidth || document.documentElement.clientWidth || 
    document.body.clientWidth;
    var height = window.innerHeight|| document.documentElement.clientHeight|| 
    document.body.clientHeight;
    
    //radius of orbit
    const orbit = [150, 300, 440, 460];
    var flameWidth = .1*1920;
    var widthChange = 1920/50;
    var flameHeight = .1*1080;
    var heightChange = 1080/50;

    stat = [6];
    //[Number, SplitNumber, Nudge]
    const constellation = [[6, 12, 0, 0], [12, 12, 0, 1], [12, 12, .5, 2]]//, [12, 12, .5, 3]]
    //const constNames = [['Vit', 'End', 'Fin', 'Ins', 'Wit', 'Res'], [], []]
    const constCost = [30, 50, 100];
    const constNames = [['Sword', 'Coin', 'Scepter', 'Wand', 'Compass', 'Cup'], ['Duel', 'Accolade', 'Patron', 'Tithe', 'Court', 'Ritual', 'Spell', 'Mystery', 'Discovery', 'Journey', 'Tryst', 'Plot'], [], []]
    star = [];
    circle = [];
    stat = [];
    galaxy = [];
    var splitPos = 0;
    function nursery(constell, name, cluster, cost)
    {
        circle[cluster] = [];
        star[cluster] = [];
        for(stell = 0; stell <constell[0]; stell+=(1))
        {
            stellar = stell+constell[2];
            split = (2*Math.PI/constell[0])*stellar;
            splitPos = split;
            star[cluster][stell] = document.createElement('div');
            star[cluster][stell].classList.add('dot');
            //star[cluster][stell].classList.add('hidden');
            star[cluster][stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            star[cluster][stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            
            circle[cluster][stell] = document.createElement('div');
            circle[cluster][stell].classList.add('node')
            circle[cluster][stell].id = 'Node'+cluster+'-'+stell
            circle[cluster][stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            circle[cluster][stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            circle[cluster][stell].addEventListener("click", (e) =>
            {
                nova();
            })
            stat[stell] = document.createElement('h1');
            stat[stell].innerHTML = cost;
            stat[stell].classList.add('stat');
            stat[stell].style.left = '50%';
            stat[stell].style.top = '50%';
            
            title = document.createElement('div');
            title.id = name[stell];
            title.innerHTML = name[stell] ?? '';
            title.style.textAlign = 'center';
            title.style.display = 'flex';
            title.style.justifyContent = 'center';
            title.style.marginTop = -0;  
            title.style.color = 'lightgray';

            stat[stell].appendChild(title);
            circle[cluster][stell].appendChild(stat[stell]);
            night.appendChild(star[cluster][stell]);
            night.appendChild(circle[cluster][stell]);
        }
        return [star, circle];
    }

    function nova()
    {
        node = event.target.closest('.node');
        //node.innerHTML = '';
        $(node).find('.stat').first()[0].style.color = 'rgba(0,0,0,0)';
        node.style.backgroundColor = 'rgba(160,110,24,.6)';
        updateList($(node).find('div').first()[0].innerHTML)
    }
    function nebula()
    {
        night = document.getElementById('night');
        for(var cluster = 0; cluster < constellation.length; cluster++)
            galaxy[cluster] = nursery(constellation[cluster], constNames[cluster], cluster, constCost[cluster]);
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
        //buttonList();
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
            align(constellation[cluster], cluster);
    }
    function align(constell, clust)
    {
        for(stell = 0; stell <constell[0]; stell+=(1))
        {
            split = (2*Math.PI/constell[0])*(stell+constell[2]);
            splitPos = split;

            star[clust][stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            star[clust][stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
            circle[clust][stell].style.left = width/2+(orbit[constell[3]]*Math.sin(splitPos));
            circle[clust][stell].style.top = height/2+(orbit[constell[3]]*Math.cos(splitPos)); 
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
    document.getElementById('statMain').addEventListener('mouseover', function()
    {
        expand(0);
    });
    document.getElementById('option0').addEventListener('mouseleave', function()
    {
        reduce(0);
    });
    function updateList(value)
    {
        list = JSON.parse(document.querySelector('#ability').innerHTML);
        list.push(value);
        document.querySelector('#ability').innerHTML = JSON.stringify(list);
        updateDatabase('ability', JSON.stringify(list));
        console.log(value);
    } 