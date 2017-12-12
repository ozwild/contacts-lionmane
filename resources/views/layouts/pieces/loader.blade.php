<style>
    .loader{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    .loader i{
        vertical-align: text-bottom;
        -webkit-animation: spin2 .7s infinite linear;
        animation: spin .7s infinite linear;
    }
    .loader span, .loader i{
        font-size: 2.3em;
    }
    @-webkit-keyframes spin2 {
        from { -webkit-transform: rotate(0deg);}
        to { -webkit-transform: rotate(360deg);}
    }
    @keyframes spin {
        from { transform: scale(1) rotate(0deg);}
        to { transform: scale(1) rotate(360deg);}
    }
</style>
<div id="loader" class="loader"><i class="material-icons">loop</i><span>Loading...</span></div>