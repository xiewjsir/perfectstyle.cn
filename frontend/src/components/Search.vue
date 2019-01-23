<template>
    <!-- 搜索框 -->
    <div class="seach">
        <form class="layui-form seach-box" action="">
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn"><i class="layui-icon layui-icon-search"></i></button>
                    <input type="text" name="username" lay-verify="required" placeholder="搜索相关" autocomplete="off" class="layui-input">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Search"
    }
</script>

<style scoped>

</style>