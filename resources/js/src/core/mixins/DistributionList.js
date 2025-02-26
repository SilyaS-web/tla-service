const eventNamesPrefix = '_DistributionList'

const DistributionList = {
    data(){
        return {
            distributionEventNames:{
                add: eventNamesPrefix + 'AddBlogger',
                remove: eventNamesPrefix + 'RemoveBlogger',
                empty: eventNamesPrefix + 'Empty',
            }
        }
    },
    methods:{
        appendBloggerToDistributionList(blogger){
            window.dispatchEvent(new CustomEvent(this.distributionEventNames.add, {
                detail: {
                    blogger: blogger
                }
            }));
        },
        removeBloggerToDistributionList(blogger){
            window.dispatchEvent(new CustomEvent(this.distributionEventNames.remove, {
                detail: {
                    blogger: blogger
                }
            }));
        },
        emptyDistributionList(){
            window.dispatchEvent(new CustomEvent(this.distributionEventNames.empty, { }));
        }
    }
}

export default DistributionList
