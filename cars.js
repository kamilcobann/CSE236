

// For Cars.html page

const menu = [
    {
        id: 1,
        title: "Renault Megane",
        category: "Segment-B",
        price: "340₺/day",
        img: 
        "https://cdn.group.renault.com/ren/master/renault-new-cars/product-plans/megane-sedan/megane-lff-ph2/2560x1440-responsive-format/renault-megane-sedan-ph2-009.jpg.ximg.large.webp/c4806de6bb.webp",
        desc : `Sedan`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 2,
        title: "Ford Fiesta",
        category: "Segment-B",
        price: "280₺/day",
        img:
        "https://cdnepws.azureedge.net/getmedia/4ef0a239-19d6-40b2-9497-01221df24229/Fiesta-Slider-1440x810.jpg.aspx?width=1440&height=810&ext=.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 3,
        title: "Toyota Yaris",
        category: "Segment-B",
        price: "300₺/day",
        img:
        "https://i.internethaber.com/2/1280/720/storage/files/images/2021/08/17/toyota-yaris-Tha7_cover.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 4,
        title: "Hyundai i20",
        category: "Segment-B",
        price: "380₺/day",
        img:
        "https://www.hyundai.com/content/dam/hyundai/tr/tr/images/find-a-car/pip/yeni-i20-2020/page/yeni-i20-6.png",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 5,
        title: "Mercedes A-180",
        category: "Segment-B",
        price: "400₺/day",
        img:
        "https://www.ssmotors.com.tr/B2ELResim/AracResim2El/16944/ab09824362a54dcca8080ca3fbd085ed2911201817245308919_0_Buyuk.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 6,
        title: "Ford Focus",
        category: "Segment-C",
        price: "450₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/EK0zR/s1/2022-ford-focus-st-line.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 7,
        title: "Honda Civic",
        category: "Segment-C",
        price: "430₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/wlom8N/s3/honda-civic-e-hev.jpg",
        desc : `Sedan`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 8,
        title: "Seat Leon",
        category: "Segment-C",
        price: "400₺/day",
        img:
        "https://i2.milimaj.com/i/milliyet/75/0x0/60099ace554284233cb3a5e1.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 9,
        title: "Peugeot 308",
        category: "Segment-C",
        price: "400₺/day",
        img:
        "https://i.internethaber.com/2/1280/720/storage/files/images/2021/12/03/peugeot-308-1zy7_cover.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 10,
        title: "Opel Astra",
        category: "Segment-C",
        price: "380₺/day",
        img:
        "https://www.sertackemiksiz.com/images/2021/07/15/yeni-opel-astra-l-tanitildi.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 11,
        title: "Citroen C4",
        category: "Segment-C",
        price: "400₺/day",
        img:
        "https://www.gototechno.com/wp-content/uploads/2021/02/2021-C4-fiyat-listesi.jpg",
        desc : `Hatchback`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 12,
        title: "Honda CR-V",
        category: "SUV",
        price: "400₺/day",
        img:
        "https://wikiimg.tojsiabtv.com/wikipedia/commons/thumb/c/c3/2018_Honda_CR-V_%28RW_MY18%29_%2BSport_2WD_wagon_%282018-10-22%29_01.jpg/1200px-2018_Honda_CR-V_%28RW_MY18%29_%2BSport_2WD_wagon_%282018-10-22%29_01.jpg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 13,
        title: "Nissan X-Trail",
        category: "SUV",
        price: "400₺/day",
        img:
        "https://www.aracdetay.net/wp-content/uploads/2018/11/nissan-x-trail-1-1280x720.jpg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 14,
        title: "Skoda Kodiaq",
        category: "SUV",
        price: "400₺/day",
        img:
        "https://www.log.com.tr/wp-content/uploads/2021/09/2021-skoda-kodiaq-1-1280x720.jpeg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 15,
        title: "Renault Koleos",
        category: "SUV",
        price: "450₺/day",
        img:
        "https://www.fiyatn.com/wp-content/uploads/2021/10/2022-Renault-Koleos-Fiyat-Listesi.jpeg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 16,
        title: "Range Rover Evoque",
        category: "SUV",
        price: "600₺/day",
        img:
        "https://www.webtekno.com/images/editor/default/0002/85/237e4f4e9d74460206435999430967207389aa05.jpeg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 17,
        title: "BMW X3",
        category: "SUV",
        price: "400₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/q4EMJ/s1/bmw-x3-2021.jpg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 18,
        title: "Volvo XC60",
        category: "SUV",
        price: "400₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/W0RWO/s3/volvo-xc60-v60-polestar-engineered.webp",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 19,
        title: "Porsche Macan",
        category: "SUV",
        price: "700₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/6nApe/s3/porsche-macan-gts-2021.jpg",
        desc : `SUV`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    {
        id: 20,
        title: "Porsche 918 Spyder",
        category: "Segment-S",
        price: "2000₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/3PGQp/s1/porsche-988-vision-concept-rendering-lead-image.jpg",
        desc : `Supercar`,
        fuel : Math.floor(Math.random() * 100) + 1
    },{
        id: 21,
        title: "BMW i8",
        category: "Segment-S",
        price: "1400₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/ew9xK/s1/2016-bmw-i8.webp",
        desc : `Supercar`,
        fuel : Math.floor(Math.random() * 100) + 1
    },{
        id: 22,
        title: "Ford GT",
        category: "Segment-S",
        price: "4000₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/oVNOE/s1/2020-ford-gt-liquid-carbon-edition.jpg",
        desc : `Supercar`,
        fuel : Math.floor(Math.random() * 100) + 1
    },{
        id: 23,
        title: "Audi R8",
        category: "Segment-S",
        price: "2000₺/day",
        img:
        "https://cdn.motor1.com/images/mgl/qjRXZ/s1/audi-r8-v10-decennium.webp",
        desc : `Supercar`,
        fuel : Math.floor(Math.random() * 100) + 1
    },
    

]


let menuContainer = document.querySelector('.section-center');
let buttonContainer = document.querySelector('.btn-container');

function createButton(btnName){
    return `<div id="${btnName}" class="btn btn-outline-dark me-2 my-3">${btnName}
    </div>`;
}

function showButtons(){
    buttonContainer.innerHTML = createButton("All-Cars")+createButton("Segment-B")+createButton("Segment-C")+
    createButton("SUV")+createButton("Segment-S");
}

listAll();
showButtons();


const allBTN = document.querySelector('#All-Cars').addEventListener('click',listAll);
const bSegBTN = document.querySelector('#Segment-B').addEventListener('click',listB);
const cSegBTN = document.querySelector('#Segment-C').addEventListener('click',listC);
const suvSegBTN = document.querySelector('#SUV').addEventListener('click',listSUV);
const sSegBTN = document.querySelector('#Segment-S').addEventListener('click',listS);

function listAll(){
    let content = " ";
    menu.map((e)=>{
        content+=createCar(e);
    })
    menuContainer.innerHTML = content;
}

function listB(){
    let content = " ";
    menu.map((e)=>{
        if(e.category=="Segment-B"){
            content+=createCar(e);
        }
    });
    menuContainer.innerHTML = content;
}
function listC(){
    let content = " ";
    menu.map((e)=>{
        if(e.category=="Segment-C"){
            content+=createCar(e);
        }
    });
    menuContainer.innerHTML = content;
}
function listSUV(){
    let content = " ";
    menu.map((e)=>{
        if(e.category=="SUV"){
            content+=createCar(e);
        }
    });
    menuContainer.innerHTML = content;
}

function listS(){
    let content = " ";
    menu.map((e)=>{
        if(e.category=="Segment-S"){
            content+=createCar(e);
        }
    });
    menuContainer.innerHTML = content;
}

function createCar(myCar){
    return `
    <div class="col mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="${myCar.img}" alt="${myCar.title}">
            <div class="card-body p-4">
                <div class="text-center">
                    <h5 class="fw-bolder card-title">${myCar.title}</h5>
                    <p class="card-text">${myCar.desc}</p>
                </div>
                <h6 class="price text-center">${myCar.price}</h6>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                <div class="text-center">Button returns none for now</div>
            </div>
        </div>
    </div>`

}

function relocate_Admin(){
    window.location = ('admin-login.php') 

}

loginDOM = document.querySelector('#loginWindow');

function popUpLogin(){
    if(loginDOM.classList.contains('show')){
        loginDOM.classList.remove('show');
    }else{
        loginDOM.classList.add('show');
    }
}

function redirectRegister(){
    window.location = ('register.php') 
}