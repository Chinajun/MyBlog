<!-- 底部 TODO 手机端无法固定在底部 -->
<template>
<div class="footer" id="footer">
  <div class="footerBox">
    <p class="footer-desc">回首向来萧瑟处，也无风雨也无晴</p>
    <p style="font-size: 16px">一个神秘的网站 - 菅野千寻的秘密基地</p>
    <p>
      网站已经运行<span v-html='longTime'>{{longTime}}</span><span class="timeJump">(●'◡'●)ﾉ♥</span>
    </p>
    <p>

    </p>
  </div>
</div>
</template>
<script>
  export default {
    data() {
      return {
        longTime:'',
      }
    },
    created() {
      this.runTime();
    },
    methods: {
      runTime:function() {
        var that = this;
        var oldTime = new Date('2020/9/24 00:00:00');
        var timer = setInterval(function () {
          var nowTime = new Date();
          var longTime = nowTime - oldTime;
          var days = parseInt(longTime / 1000 / 60 / 60 / 24, 10);
          var hours = parseInt(longTime / 1000 / 60 / 60 % 24, 10);
          var minutes = parseInt(longTime / 1000 / 60 % 60, 10);
          var seconds = parseInt(longTime / 1000 % 60, 10);
          that.longTime = days + "天" + hours + "小时" + minutes + "分" + seconds + "秒";
        }, 1000);
      },
    },
  }
</script>
<style>
  .footer{
    min-width: 1200px;
    color:#888;
    font-size: 12px;
    line-height: 1.5;
    text-align: center;
    width:100%;
    min-height: 50px;
    position: absolute;
  }
  .footerBox{
    width:100%;
    background: #232323;
    padding:15px 10px 10px 10px;
    box-sizing: border-box;
  }
  .footerBox p{
    margin: 5px 0;
  }
  .footer-desc{
    font-family: 'helloFont';
    font-size: 25px;
    padding-bottom: 10px;
  }
  /*时间跳动*/
  .timeJump{
    animation:my-face 5s infinite ease-in-out;
    -webkit-animation:my-face 5s infinite ease-in-out;
    display:inline-block;
    margin:0 5px;
  }
  @-webkit-keyframes my-face {
    2% {
      -webkit-transform:translate(0,1.5px) rotate(1.5deg);
      -moz-transform:translate(0,1.5px) rotate(1.5deg);
      -ms-transform:translate(0,1.5px) rotate(1.5deg);
      -o-transform:translate(0,1.5px) rotate(1.5deg);
      transform:translate(0,1.5px) rotate(1.5deg)
    }
    4% {
      -webkit-transform:translate(0,-1.5px) rotate(-.5deg);
      -moz-transform:translate(0,-1.5px) rotate(-.5deg);
      -ms-transform:translate(0,-1.5px) rotate(-.5deg);
      -o-transform:translate(0,-1.5px) rotate(-.5deg);
      transform:translate(0,-1.5px) rotate(-.5deg)
    }
    6% {
      -webkit-transform:translate(0,1.5px) rotate(-1.5deg);
      -moz-transform:translate(0,1.5px) rotate(-1.5deg);
      -ms-transform:translate(0,1.5px) rotate(-1.5deg);
      -o-transform:translate(0,1.5px) rotate(-1.5deg);
      transform:translate(0,1.5px) rotate(-1.5deg)
    }
    8% {
      -webkit-transform:translate(0,-1.5px) rotate(-1.5deg);
      -moz-transform:translate(0,-1.5px) rotate(-1.5deg);
      -ms-transform:translate(0,-1.5px) rotate(-1.5deg);
      -o-transform:translate(0,-1.5px) rotate(-1.5deg);
      transform:translate(0,-1.5px) rotate(-1.5deg)
    }
    10% {
      -webkit-transform:translate(0,2.5px) rotate(1.5deg);
      -moz-transform:translate(0,2.5px) rotate(1.5deg);
      -ms-transform:translate(0,2.5px) rotate(1.5deg);
      -o-transform:translate(0,2.5px) rotate(1.5deg);
      transform:translate(0,2.5px) rotate(1.5deg)
    }
    12% {
      -webkit-transform:translate(0,-.5px) rotate(1.5deg);
      -moz-transform:translate(0,-.5px) rotate(1.5deg);
      -ms-transform:translate(0,-.5px) rotate(1.5deg);
      -o-transform:translate(0,-.5px) rotate(1.5deg);
      transform:translate(0,-.5px) rotate(1.5deg)
    }
    14% {
      -webkit-transform:translate(0,-1.5px) rotate(1.5deg);
      -moz-transform:translate(0,-1.5px) rotate(1.5deg);
      -ms-transform:translate(0,-1.5px) rotate(1.5deg);
      -o-transform:translate(0,-1.5px) rotate(1.5deg);
      transform:translate(0,-1.5px) rotate(1.5deg)
    }
    16% {
      -webkit-transform:translate(0,-.5px) rotate(-1.5deg);
      -moz-transform:translate(0,-.5px) rotate(-1.5deg);
      -ms-transform:translate(0,-.5px) rotate(-1.5deg);
      -o-transform:translate(0,-.5px) rotate(-1.5deg);
      transform:translate(0,-.5px) rotate(-1.5deg)
    }
    18% {
      -webkit-transform:translate(0,.5px) rotate(-1.5deg);
      -moz-transform:translate(0,.5px) rotate(-1.5deg);
      -ms-transform:translate(0,.5px) rotate(-1.5deg);
      -o-transform:translate(0,.5px) rotate(-1.5deg);
      transform:translate(0,.5px) rotate(-1.5deg)
    }
    20% {
      -webkit-transform:translate(0,-1.5px) rotate(2.5deg);
      -moz-transform:translate(0,-1.5px) rotate(2.5deg);
      -ms-transform:translate(0,-1.5px) rotate(2.5deg);
      -o-transform:translate(0,-1.5px) rotate(2.5deg);
      transform:translate(0,-1.5px) rotate(2.5deg)
    }
    22% {
      -webkit-transform:translate(0,.5px) rotate(-1.5deg);
      -moz-transform:translate(0,.5px) rotate(-1.5deg);
      -ms-transform:translate(0,.5px) rotate(-1.5deg);
      -o-transform:translate(0,.5px) rotate(-1.5deg);
      transform:translate(0,.5px) rotate(-1.5deg)
    }
    24% {
      -webkit-transform:translate(0,1.5px) rotate(1.5deg);
      -moz-transform:translate(0,1.5px) rotate(1.5deg);
      -ms-transform:translate(0,1.5px) rotate(1.5deg);
      -o-transform:translate(0,1.5px) rotate(1.5deg);
      transform:translate(0,1.5px) rotate(1.5deg)
    }
    26% {
      -webkit-transform:translate(0,.5px) rotate(.5deg);
      -moz-transform:translate(0,.5px) rotate(.5deg);
      -ms-transform:translate(0,.5px) rotate(.5deg);
      -o-transform:translate(0,.5px) rotate(.5deg);
      transform:translate(0,.5px) rotate(.5deg)
    }
    28% {
      -webkit-transform:translate(0,.5px) rotate(1.5deg);
      -moz-transform:translate(0,.5px) rotate(1.5deg);
      -ms-transform:translate(0,.5px) rotate(1.5deg);
      -o-transform:translate(0,.5px) rotate(1.5deg);
      transform:translate(0,.5px) rotate(1.5deg)
    }
    30% {
      -webkit-transform:translate(0,-.5px) rotate(2.5deg);
      -moz-transform:translate(0,-.5px) rotate(2.5deg);
      -ms-transform:translate(0,-.5px) rotate(2.5deg);
      -o-transform:translate(0,-.5px) rotate(2.5deg);
      transform:translate(0,-.5px) rotate(2.5deg)
    }
    32% {
      -webkit-transform:translate(0,1.5px) rotate(-.5deg);
      -moz-transform:translate(0,1.5px) rotate(-.5deg);
      -ms-transform:translate(0,1.5px) rotate(-.5deg);
      -o-transform:translate(0,1.5px) rotate(-.5deg);
      transform:translate(0,1.5px) rotate(-.5deg)
    }
    34% {
      -webkit-transform:translate(0,1.5px) rotate(-.5deg);
      -moz-transform:translate(0,1.5px) rotate(-.5deg);
      -ms-transform:translate(0,1.5px) rotate(-.5deg);
      -o-transform:translate(0,1.5px) rotate(-.5deg);
      transform:translate(0,1.5px) rotate(-.5deg)
    }
    36% {
      -webkit-transform:translate(0,-1.5px) rotate(2.5deg);
      -moz-transform:translate(0,-1.5px) rotate(2.5deg);
      -ms-transform:translate(0,-1.5px) rotate(2.5deg);
      -o-transform:translate(0,-1.5px) rotate(2.5deg);
      transform:translate(0,-1.5px) rotate(2.5deg)
    }
    38% {
      -webkit-transform:translate(0,1.5px) rotate(-1.5deg);
      -moz-transform:translate(0,1.5px) rotate(-1.5deg);
      -ms-transform:translate(0,1.5px) rotate(-1.5deg);
      -o-transform:translate(0,1.5px) rotate(-1.5deg);
      transform:translate(0,1.5px) rotate(-1.5deg)
    }
    40% {
      -webkit-transform:translate(0,-.5px) rotate(2.5deg);
      -moz-transform:translate(0,-.5px) rotate(2.5deg);
      -ms-transform:translate(0,-.5px) rotate(2.5deg);
      -o-transform:translate(0,-.5px) rotate(2.5deg);
      transform:translate(0,-.5px) rotate(2.5deg)
    }
    42% {
      -webkit-transform:translate(0,2.5px) rotate(-1.5deg);
      -moz-transform:translate(0,2.5px) rotate(-1.5deg);
      -ms-transform:translate(0,2.5px) rotate(-1.5deg);
      -o-transform:translate(0,2.5px) rotate(-1.5deg);
      transform:translate(0,2.5px) rotate(-1.5deg)
    }
    44% {
      -webkit-transform:translate(0,1.5px) rotate(.5deg);
      -moz-transform:translate(0,1.5px) rotate(.5deg);
      -ms-transform:translate(0,1.5px) rotate(.5deg);
      -o-transform:translate(0,1.5px) rotate(.5deg);
      transform:translate(0,1.5px) rotate(.5deg)
    }
    46% {
      -webkit-transform:translate(0,-1.5px) rotate(2.5deg);
      -moz-transform:translate(0,-1.5px) rotate(2.5deg);
      -ms-transform:translate(0,-1.5px) rotate(2.5deg);
      -o-transform:translate(0,-1.5px) rotate(2.5deg);
      transform:translate(0,-1.5px) rotate(2.5deg)
    }
    48% {
      -webkit-transform:translate(0,-.5px) rotate(.5deg);
      -moz-transform:translate(0,-.5px) rotate(.5deg);
      -ms-transform:translate(0,-.5px) rotate(.5deg);
      -o-transform:translate(0,-.5px) rotate(.5deg);
      transform:translate(0,-.5px) rotate(.5deg)
    }
    50% {
      -webkit-transform:translate(0,.5px) rotate(.5deg);
      -moz-transform:translate(0,.5px) rotate(.5deg);
      -ms-transform:translate(0,.5px) rotate(.5deg);
      -o-transform:translate(0,.5px) rotate(.5deg);
      transform:translate(0,.5px) rotate(.5deg)
    }
    52% {
      -webkit-transform:translate(0,2.5px) rotate(2.5deg);
      -moz-transform:translate(0,2.5px) rotate(2.5deg);
      -ms-transform:translate(0,2.5px) rotate(2.5deg);
      -o-transform:translate(0,2.5px) rotate(2.5deg);
      transform:translate(0,2.5px) rotate(2.5deg)
    }
    54% {
      -webkit-transform:translate(0,-1.5px) rotate(1.5deg);
      -moz-transform:translate(0,-1.5px) rotate(1.5deg);
      -ms-transform:translate(0,-1.5px) rotate(1.5deg);
      -o-transform:translate(0,-1.5px) rotate(1.5deg);
      transform:translate(0,-1.5px) rotate(1.5deg)
    }
    56% {
      -webkit-transform:translate(0,2.5px) rotate(2.5deg);
      -moz-transform:translate(0,2.5px) rotate(2.5deg);
      -ms-transform:translate(0,2.5px) rotate(2.5deg);
      -o-transform:translate(0,2.5px) rotate(2.5deg);
      transform:translate(0,2.5px) rotate(2.5deg)
    }
    58% {
      -webkit-transform:translate(0,.5px) rotate(2.5deg);
      -moz-transform:translate(0,.5px) rotate(2.5deg);
      -ms-transform:translate(0,.5px) rotate(2.5deg);
      -o-transform:translate(0,.5px) rotate(2.5deg);
      transform:translate(0,.5px) rotate(2.5deg)
    }
    60% {
      -webkit-transform:translate(0,2.5px) rotate(2.5deg);
      -moz-transform:translate(0,2.5px) rotate(2.5deg);
      -ms-transform:translate(0,2.5px) rotate(2.5deg);
      -o-transform:translate(0,2.5px) rotate(2.5deg);
      transform:translate(0,2.5px) rotate(2.5deg)
    }
    62% {
      -webkit-transform:translate(0,-.5px) rotate(2.5deg);
      -moz-transform:translate(0,-.5px) rotate(2.5deg);
      -ms-transform:translate(0,-.5px) rotate(2.5deg);
      -o-transform:translate(0,-.5px) rotate(2.5deg);
      transform:translate(0,-.5px) rotate(2.5deg)
    }
    64% {
      -webkit-transform:translate(0,-.5px) rotate(1.5deg);
      -moz-transform:translate(0,-.5px) rotate(1.5deg);
      -ms-transform:translate(0,-.5px) rotate(1.5deg);
      -o-transform:translate(0,-.5px) rotate(1.5deg);
      transform:translate(0,-.5px) rotate(1.5deg)
    }
    66% {
      -webkit-transform:translate(0,1.5px) rotate(-.5deg);
      -moz-transform:translate(0,1.5px) rotate(-.5deg);
      -ms-transform:translate(0,1.5px) rotate(-.5deg);
      -o-transform:translate(0,1.5px) rotate(-.5deg);
      transform:translate(0,1.5px) rotate(-.5deg)
    }
    68% {
      -webkit-transform:translate(0,-1.5px) rotate(-.5deg);
      -moz-transform:translate(0,-1.5px) rotate(-.5deg);
      -ms-transform:translate(0,-1.5px) rotate(-.5deg);
      -o-transform:translate(0,-1.5px) rotate(-.5deg);
      transform:translate(0,-1.5px) rotate(-.5deg)
    }
    70% {
      -webkit-transform:translate(0,1.5px) rotate(.5deg);
      -moz-transform:translate(0,1.5px) rotate(.5deg);
      -ms-transform:translate(0,1.5px) rotate(.5deg);
      -o-transform:translate(0,1.5px) rotate(.5deg);
      transform:translate(0,1.5px) rotate(.5deg)
    }
    72% {
      -webkit-transform:translate(0,2.5px) rotate(1.5deg);
      -moz-transform:translate(0,2.5px) rotate(1.5deg);
      -ms-transform:translate(0,2.5px) rotate(1.5deg);
      -o-transform:translate(0,2.5px) rotate(1.5deg);
      transform:translate(0,2.5px) rotate(1.5deg)
    }
    74% {
      -webkit-transform:translate(0,-.5px) rotate(.5deg);
      -moz-transform:translate(0,-.5px) rotate(.5deg);
      -ms-transform:translate(0,-.5px) rotate(.5deg);
      -o-transform:translate(0,-.5px) rotate(.5deg);
      transform:translate(0,-.5px) rotate(.5deg)
    }
    76% {
      -webkit-transform:translate(0,-.5px) rotate(2.5deg);
      -moz-transform:translate(0,-.5px) rotate(2.5deg);
      -ms-transform:translate(0,-.5px) rotate(2.5deg);
      -o-transform:translate(0,-.5px) rotate(2.5deg);
      transform:translate(0,-.5px) rotate(2.5deg)
    }
    78% {
      -webkit-transform:translate(0,-.5px) rotate(1.5deg);
      -moz-transform:translate(0,-.5px) rotate(1.5deg);
      -ms-transform:translate(0,-.5px) rotate(1.5deg);
      -o-transform:translate(0,-.5px) rotate(1.5deg);
      transform:translate(0,-.5px) rotate(1.5deg)
    }
    80% {
      -webkit-transform:translate(0,1.5px) rotate(1.5deg);
      -moz-transform:translate(0,1.5px) rotate(1.5deg);
      -ms-transform:translate(0,1.5px) rotate(1.5deg);
      -o-transform:translate(0,1.5px) rotate(1.5deg);
      transform:translate(0,1.5px) rotate(1.5deg)
    }
    82% {
      -webkit-transform:translate(0,-.5px) rotate(.5deg);
      -moz-transform:translate(0,-.5px) rotate(.5deg);
      -ms-transform:translate(0,-.5px) rotate(.5deg);
      -o-transform:translate(0,-.5px) rotate(.5deg);
      transform:translate(0,-.5px) rotate(.5deg)
    }
    84% {
      -webkit-transform:translate(0,1.5px) rotate(2.5deg);
      -moz-transform:translate(0,1.5px) rotate(2.5deg);
      -ms-transform:translate(0,1.5px) rotate(2.5deg);
      -o-transform:translate(0,1.5px) rotate(2.5deg);
      transform:translate(0,1.5px) rotate(2.5deg)
    }
    86% {
      -webkit-transform:translate(0,-1.5px) rotate(-1.5deg);
      -moz-transform:translate(0,-1.5px) rotate(-1.5deg);
      -ms-transform:translate(0,-1.5px) rotate(-1.5deg);
      -o-transform:translate(0,-1.5px) rotate(-1.5deg);
      transform:translate(0,-1.5px) rotate(-1.5deg)
    }
    88% {
      -webkit-transform:translate(0,-.5px) rotate(2.5deg);
      -moz-transform:translate(0,-.5px) rotate(2.5deg);
      -ms-transform:translate(0,-.5px) rotate(2.5deg);
      -o-transform:translate(0,-.5px) rotate(2.5deg);
      transform:translate(0,-.5px) rotate(2.5deg)
    }
    90% {
      -webkit-transform:translate(0,2.5px) rotate(-.5deg);
      -moz-transform:translate(0,2.5px) rotate(-.5deg);
      -ms-transform:translate(0,2.5px) rotate(-.5deg);
      -o-transform:translate(0,2.5px) rotate(-.5deg);
      transform:translate(0,2.5px) rotate(-.5deg)
    }
    92% {
      -webkit-transform:translate(0,.5px) rotate(-.5deg);
      -moz-transform:translate(0,.5px) rotate(-.5deg);
      -ms-transform:translate(0,.5px) rotate(-.5deg);
      -o-transform:translate(0,.5px) rotate(-.5deg);
      transform:translate(0,.5px) rotate(-.5deg)
    }
    94% {
      -webkit-transform:translate(0,2.5px) rotate(.5deg);
      -moz-transform:translate(0,2.5px) rotate(.5deg);
      -ms-transform:translate(0,2.5px) rotate(.5deg);
      -o-transform:translate(0,2.5px) rotate(.5deg);
      transform:translate(0,2.5px) rotate(.5deg)
    }
    96% {
      -webkit-transform:translate(0,-.5px) rotate(1.5deg);
      -moz-transform:translate(0,-.5px) rotate(1.5deg);
      -ms-transform:translate(0,-.5px) rotate(1.5deg);
      -o-transform:translate(0,-.5px) rotate(1.5deg);
      transform:translate(0,-.5px) rotate(1.5deg)
    }
    98% {
      -webkit-transform:translate(0,-1.5px) rotate(-.5deg);
      -moz-transform:translate(0,-1.5px) rotate(-.5deg);
      -ms-transform:translate(0,-1.5px) rotate(-.5deg);
      -o-transform:translate(0,-1.5px) rotate(-.5deg);
      transform:translate(0,-1.5px) rotate(-.5deg)
    }
    0%,100% {
      -webkit-transform:translate(0,0) rotate(0);
      -moz-transform:translate(0,0) rotate(0);
      -ms-transform:translate(0,0) rotate(0);
      -o-transform:translate(0,0) rotate(0);
      transform:translate(0,0) rotate(0)
    }
  }
</style>
