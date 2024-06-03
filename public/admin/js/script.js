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
        $(this.node).find('.form-stat__title').on('click', (e) => this.statCardClick(e))

        return this;
    }

    sendUri = '/apist/admin/bloggers/accept';

    blogger_id = '';

    statCardClick = (e) => {
        console.log($(e.target).closest('.form-stat'));
        $(e.target).closest('.form-stat').toggleClass('active');
    }

    dataProps = {
        gender_ratio: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#gender_ratio').val();
            }
        },
        sex: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#sex').val();
            }
        },
        is_achievement: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#is_achievement').val();
            }
        },

        tg_subs: {
            get: ()=>{
                return $(this.node).find('#tg_subs').val();
            }
        },
        tg_cover: {
            get: ()=>{
                return $(this.node).find('#tg_cover').val();
            }
        },
        tg_er: {
            get: ()=>{
                return $(this.node).find('#tg_er').val();
            }
        },
        tg_cpm: {
            get: ()=>{
                return $(this.node).find('#tg_cpm').val();
            }
        },

        inst_subs: {
            get: ()=>{
                return $(this.node).find('#inst_subs').val();
            }
        },
        inst_cover: {
            get: ()=>{
                return $(this.node).find('#inst_cover').val();
            }
        },
        inst_er: {
            get: ()=>{
                return $(this.node).find('#inst_er').val();
            }
        },
        inst_cpm: {
            get: ()=>{
                return $(this.node).find('#inst_cpm').val();
            }
        },

        yt_subs: {
            get: ()=>{
                return $(this.node).find('#yt_subs').val();
            }
        },
        yt_cover: {
            get: ()=>{
                return $(this.node).find('#yt_cover').val();
            }
        },
        yt_er: {
            get: ()=>{
                return $(this.node).find('#yt_er').val();
            }
        },
        yt_cpm: {
            get: ()=>{
                return $(this.node).find('#yt_cpm').val();
            }
        },
    }

    sendData = () => {
        var self = this;

        $.post(self.sendUri, {
            user_id: self.blogger_id,
            gender_ratio: self.dataProps.gender_ratio.get(),
            sex: self.dataProps.sex.get(),
            is_achievement: self.dataProps.is_achievement.get(),

            tg_subs: self.dataProps.tg_subs.get(),
            tg_cover: self.dataProps.tg_cover.get(),
            tg_er: self.dataProps.tg_er.get(),
            tg_cpm: self.dataProps.tg_cpm.get(),

            inst_subs: self.dataProps.inst_subs.get(),
            inst_cover: self.dataProps.inst_cover.get(),
            inst_er: self.dataProps.inst_er.get(),
            inst_cpm: self.dataProps.inst_cpm.get(),

            yt_subs: self.dataProps.yt_subs.get(),
            yt_cover: self.dataProps.yt_cover.get(),
            yt_er: self.dataProps.yt_er.get(),
            yt_cpm: self.dataProps.yt_cpm.get(),
        }, function(res){
            notify('info', {title: 'Успешно!', message: ''});
            self.closePopup();
        })
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
    var acceptBlogerForm;
    $(document).on('click', '.btn-accept', function(e){
        e.preventDefault();

        if(!acceptBlogerForm){
            acceptBlogerForm = new PopupAcceptBloger('#accept-form');
        }

        acceptBlogerForm.blogger_id = e.target.dataset.id
        acceptBlogerForm.openPopup()
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
