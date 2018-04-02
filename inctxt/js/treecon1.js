    $(function() {    
    
    var data = [
    
    {
        label: '越南语900句',
        children: [
            { label: '学校和教育 ' },
            { label: '工作和职业 ' },
            { label: '购物 ' },
            { label: '找工作 ' },    
            { label: '找房子 ' },    
            { label: '约会 ' }, 
            { label: '婚姻 ' }, 
            { label: '爱与激情 ' }, 
            { label: '宗教与信仰 ' },             
            
            { label: '休闲娱乐' ,children: [
            { label: '爱好和消遣 ' },							
            { label: '节假日 ' },         
            { label: '观光 ' }, 
            { label: '旅行 ' }, 
            { label: '徒步旅行 ' },             
            { label: '露营 ' },           
            { label: '野餐 ' }, 
            { label: '体育 ' }, 
            { label: '网上冲浪 ' }, 
            { label: '电影 ' }, 
            { label: '电台和电视 ' }, 
            { label: '报纸和杂志 ' }, 
            { label: '音乐和音乐会 ' }
                              
                              ]},
            
            
            { label: '心理心情' ,children: [
                              { label: '嘲笑 ' },
                              { label: '欺骗 ' },
                              { label: '恐惧 ' },	
                              { label: '嫉妒 ' },
                              { label: '悲伤 ' },
                              { label: '奉承 ' },			
				              { label: '担忧 ' },
				              { label: '偏好 ' },
				              { label: '失望 ' },
				              { label: '愤怒 ' },
				              { label: '悲观 ' },
				              { label: '乐观主义 ' },
				              { label: '同情 ' },				              
                              { label: '无聊 ' },
                              { label: '憎恨 ' },	
                              { label: '羞耻 ' },
                              { label: '威胁 ' },
                              { label: '责备 ' } ]},
                
            { label: '经历' ,children: [
                              { label: '难忘的经历 ' },
                              { label: '美好的回忆 ' },
                              { label: '值得回忆的人 ' },	
                              { label: '令人欣喜的经历 ' },
                              { label: '令人激动的经历 ' },
                              { label: '难堪的经历 ' },			
				              { label: '危险的经历 ' },
				              { label: '神秘的经历 ' },
				              { label: '浪漫的经历 ' },
				              { label: '网恋 ' },
				              { label: '可怕的经历 ' },
				              { label: '愚蠢的经历 ' },
				              { label: '冒险的经历 ' },				              
                              { label: '成功的经历 ' },
                              { label: '失败的经历 ' },	
                              { label: '宁静的经历 ' },
                              { label: '悲惨的经历 ' },
                              { label: '困惑的经历 ' },
                              { label: '孤独的经历 ' },
                              { label: '勇敢的经历 ' }]}
            //{ label: 'child2' }
        ]
    },    
    
    
    
                { label: '常用对话' ,children: [
                              { label: ' 对话用语1' },
                              { label: ' 对话用语2' },
                              { label: ' 对话用语3' }
                              
                                ]},
    
    
    
  {  
	  
    label: '越南语语法',
      children: [
        { label: ' 越南语基本知识', },
        { label: ' trạng_từ_副词', },
        { label: ' 词典3600', },
        { label: ' 小词典_A_E', },
        { label: ' 小词典_G_M', },
        { label: ' 小词典_T_Y', }        
        //'<a href="example3.html">Example 3</a>'
      ]
  },
  
    {  
	  
    label: '越中对照阅读',
      children: [
        { label: ' 幽默故事', }
        //'<a href="example3.html">Example 3</a>'
      ]
  }
];


$('#tree1').tree({
  data: data,
  autoEscape: false,
  autoOpen: false
});


  $('#tree1').bind(
    'tree.click',
    function(event) {
        // The clicked node is 'event.node'
        var node = event.node;
        var nn = node.name;
        
var str2 = " ";
if(nn.indexOf(str2) != -1){
	
	//var lines = nn.split(str2);
	//var nn1 = lines[0];	
   // alert(nn1);
    
        $.post('/', {
        'q': nn
    }, function (data1) {

        $('#main-content').html(data1);
        $('.ajax-loader').hide();



    });    
    
    
}else{return false;}             
        
        
    }
);

   
  }); 




$(function () {	
	
	    $(document).on("click", '#btnSubmit', function (e) {	
	        $('#main-content').html('');
        $('.ajax-loader').show();
$.ajax({
type: "POST",
url: '/',
data: "fname=" + $('#fname').val(),
success: function(data){  
	          
        $('#main-content').html(data); 
        $('.ajax-loader').hide();
}
});

});



	    $(document).on("click", '#vndic', function (e) {	
	        $('#main-content').html('');
        $('.ajax-loader').show();
$.ajax({
type: "POST",
url: '/',
data: "ffname=" + $('#fname').val(),
success: function(data){  
	          
        $('#main-content').html(data); 
        $('.ajax-loader').hide();
}
});

});

});
