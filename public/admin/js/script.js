class Tabs {
    constructor(node) {
        this.node = node;
        
        $(this.node).find('.tab').on('click', (e)=>{
            e.preventDefault();
            this.tabClick(e)
        });

        return this;
    }
    node = '';
    dataProps = {
        
    }
    tabClick = (e)=>{
        var curTab = $(e.target).closest('.tab');

        $('.tab').removeClass('active');
        $('.tab-content').removeClass('active');

        curTab.addClass('active');
        $(`#${curTab.data('content')}`).addClass('active')
    }
}

class Popup{
    constructor(node) {
        this.node = node;

        $(this.node).find('.close-popup').on('click', this.closePopup)
        
        return this;
    }
    
    node = '';
    
    openPopup = () => {
        $(this.node).addClass('opened');
    }
    
    closePopup = () => {
        $(this.node).removeClass('opened');
    }
}

class PopupAcceptBloger extends Popup{
    constructor(node){
        super(node);
        
        $(this.node).find('.btn.send-data').on('click', this.sendData)

        return this;
    }

    sendUri = '#';
    dataProps = {
        name: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#name').val();
            }
        },
        phone: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#phone').val();
            }
        }
    }
    sendData = {

    }
}

class PopupAchivmentsManagement extends Popup{
    constructor(node){
        super(node);

        return this;
    }

    sendUri = '#';
    blogerId = '';
    dataProps = {
        name: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#name').val();
            }
        },
        phone: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#phone').val();
            }
        }
    }
    blogerAchivments = {}
    getAchivments = ()=>{
        console.log(this.blogerId)
    }
    saveData = ()=>{

    }
}

function notify(type, content){
    $('.notification').show()
    $('.notification').addClass(type)
    $('.notification .notification__title').text(content.title);
    $('.notification .notification__text').text(content.message);
    
    setTimeout(()=>{
        $('.notification').hide()
        $('.notification').removeClass(type)
        $('.notification .notification__text').text('');
    }, 5000)
}

$(window).on('load', function(){
    //popups
    $(document).on('click', '.btn-accept', function(e){
        e.preventDefault();
        let form = new PopupAcceptBloger('#accept-form');
        form.openPopup()
    })

    var adminTabs = new Tabs('.admin-view');

    $(document).on('click', '.btn-achivments-form', function(e){
        var achivmentsForm = new PopupAchivmentsManagement('#achivments-form');
        achivmentsForm.blogerId = $(e.target).closest('.bloger-item').data('id');
        achivmentsForm.getAchivments();
        achivmentsForm.openPopup();
    })
    
})

function ibg(){ 
    let ibg = $('._ibg'); 

    $(ibg).each((i, item)=>{
        if(img = $(item).find('img')){
            $(item).css("background-image", 'url("' + img.attr('src') + '")');
        }
    })   
} 

window.addEventListener('load', ibg)