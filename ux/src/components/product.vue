<!-- TODO 可删除 -->
<template>
  <div>
    <el-upload class="upload" :on-preview="handlePreview" accept=".xls,.xlsx" :before-upload="beforeUpload"
               action="/api/product/saveProduct" :on-success="handleSuccess">
      <el-button size="small" type="primary">上传并保存</el-button>
      <div slot="tip" class="el-upload__tip">只能上传excel文件，且不超过一个</div>
    </el-upload>
    <div>
      <el-upload class="upload" :on-preview="handlePreview" accept=".xls,.xlsx" :before-upload="beforeUpload" :on-remove="handleRemove"
                 action="/api/product/readProduct" :on-success="handleSuccess2">
        <el-button size="small" type="primary">上传查询文件</el-button>
        <div slot="tip" class="el-upload__tip">只能上传excel文件</div>
      </el-upload>
      <el-button size="small" type="primary" @click="findInfo">查询</el-button>
      <el-input v-model="find" type="text"></el-input>
    </div>
    <div class="block" style="float: right">
      <el-pagination layout="prev, pager, next" :total="total" @current-change="handleCurrentChange">
      </el-pagination>
    </div>
    <br>
    <el-table :data="tableData" border style="width: 100%">
      <el-table-column prop="id" label="序号">
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column prop="product_id" label="货号"></el-table-column>
      <el-table-column prop="product_name" label="商品名称"></el-table-column>
      <el-table-column prop="supplier" label="供应商"></el-table-column>
      <el-table-column prop="brand" label="品牌"></el-table-column>
      <el-table-column prop="type" label="规格/型号"></el-table-column>
      <el-table-column prop="unit" label="单位"></el-table-column>
      <el-table-column prop="period" label="货期"></el-table-column>
      <el-table-column prop="count" label="数量"></el-table-column>
      <el-table-column prop="market_price" label="市场价"></el-table-column>
      <el-table-column prop="product_price" label="进货价"></el-table-column>
      <el-table-column prop="total_price" label="总价"></el-table-column>
      <el-table-column prop="phone" label="联系方式"></el-table-column>
      <el-table-column prop="remark" label="备注"></el-table-column>
      <el-table-column label="管理产品">
        <template slot-scope="scope">
          <el-button type="danger" icon="el-icon-delete" circle @click="dele(scope.$index)"></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>
<script>
  import axios from "axios";
  export default{
    data:function (){
      return{
        tableData:[],
        currentPage:'1',
        total:'',
        find:'',
        status:'0'
      }
    },
    mounted:function(){
      this.getProduct();
    },
    methods:{
      //点击已上传的文件链接时的钩子, 可以通过 file.response 拿到服务端返回数据
      handlePreview(file) {
        console.log(file);
      },
      //判断文件格式
      beforeUpload(file) {
        var testmsg=file.name.substring(file.name.lastIndexOf('.')+1);
        const extension = testmsg === 'xls';
        const extension2 = testmsg === 'xlsx';
        if(!extension && !extension2) {
          this.$message({
            message: '上传文件只能是 xls、xlsx格式!',
            type: 'warning'
          });
        }
        return extension || extension2;
      },
      //文件上传成功时的钩子
      handleSuccess(response, file, fileList){
        this.getProduct();
      },
      getProduct(){
        let from = (this.currentPage - 1) * 10;
        axios.post("/api/product/getProduct",{
          from:from
        }).then((response) => {
            this.tableData=[];
            this.total=response.data.data.count;
            for(let i=0;i<response.data.data.result.length;i++){
              this.tableData.push(response.data.data.result[i]);
            }
        }).catch(function (error) {
          console.log(error);
        });
      },
      dele(index){
        this.$confirm('确定删除该数据?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          axios.post("/api/product/deleteProduct", {
            product_id: this.tableData[index].product_id
          }).then((response) => {
            if (response.data.code === 0) {
              this.$message({
                message: response.data.msg,
                type: 'success'
              });
              this.$router.go(0);//刷新界面
            }
          }).catch(function (error) {
            console.log(error);
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          });
        });

      },
      //分页
      handleCurrentChange(val) {
        this.currentPage = val;//当前页码
        if(this.status==0){//如果status为0,全部产品分页
          this.getProduct();
        }else{//点击查询按钮后，status=1，查询产品分页
          this.findInfo();
        }
      },
      //上传查询文件的处理函数
      handleSuccess2(response, file, fileList){
        this.find=response.data;
      },
      //查询按钮实现函数
      findInfo(){
        this.status=1;
        let from = (this.currentPage - 1) * 10;
        axios.post("/api/product/findProduct", {
          str:this.find,from:from
        }).then((response) => {
            this.tableData=[];
            this.total=response.data.data.count;
            for(let i=0;i<response.data.data.result.length;i++){
              this.tableData.push(response.data.data.result[i]);
            }
        }).catch(function (error) {
          console.log(error);
        });
      },
      //移除查询文件后显示全部产品信息
      handleRemove(){
        this.status=0;
        this.getProduct();
      }
    }
  }
</script>
