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

class PopupConfirmDeletion extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.close-popup-btn').on('click', this.closePopup)
        $(this.node).find('.send-data').on('click', ()=>{
            var self = this;

            $.ajax({
                url: '/apist/users/' + self.id,
                type: 'DELETE',
                success: function(result) {
                    self.card.remove();
                    self.closePopup()
                }
            });
        })

        if(!this.instagramance) this.instagramance = this;

        return this.instagramance;
    }
    instagramance = null;

    node = '';
    id = '';
    card = '';
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
    $(document).on('click', '.card__delete', function(e){
        var btn = $(e.currentTarget);

        e.preventDefault();

        confirmationPopup = new PopupConfirmDeletion('#confirm-deletion');

        confirmationPopup.id = btn.data('id')
        confirmationPopup.card = btn.closest('.card')
        confirmationPopup.openPopup()
    })

    $(document).on('click', '.header__menu-btn', function(){
        $('.admin-view__container').toggleClass('active-menu')
    })

    var adminTabs = new Tabs('.admin-view');

    $(document).on('click', '.btn-achivments-form', function(e){
        var achivmentsForm = new PopupAchivmentsManagement('#achivments-form');
        achivmentsForm.blogerId = $(e.target).closest('.bloger-item').data('id');
        achivmentsForm.getAchivments();
        achivmentsForm.openPopup();
    })


    $(document).on('click', '.blogers-search-btn', function(){
        let search = $(document).find('#blogers-search').val();

        $.post('/apist/admin/bloggers', {
            name: search
        },
        function(res){
            $('#blogers-list').find('.list-blogers').remove();
            $('#blogers-list').find('.admin-blogers__body').append(res);
        })
    })

    $(document).on('click', '.sellers-search-btn', function(){
        let search = $(document).find('#sellers-search').val();

        $.post('/apist/admin/sellers', {
            name: search
        },
        function(res){
            $('#sellers-list').find('.list-blogers').remove();
            $('#sellers-list').find('.admin-blogers__body').append(res);
        })
    })

    $(document).on('click', '.moderation-search-btn', function(){
        let search = $(document).find('#moderation-search').val();

        $.post('/apist/admin/moderation', {
            name: search
        },
        function(res){
            $('#moderation').find('.list-blogers').remove();
            $('#moderation').find('.admin-blogers__body').append(res);
        })
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
