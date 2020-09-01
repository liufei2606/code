package main.algrithom;

import java.util.LinkedList;
import java.util.List;

public class BackTrack {

    /**
     * 知道n个不重复的数，全排列共有 n! 个
     */
    static List<List<Integer>> res = new LinkedList<>();

    /* 主函数，输入一组不重复的数字，返回它们的全排列 */
    static List<List<Integer>> permute(int[] nums) {
        // 记录「路径」
        LinkedList<Integer> track = new LinkedList<>();
        backtrack(nums, track);
        return res;
    }

    // 路径：记录在 track 中
// 选择列表：nums 中不存在于 track 的那些元素
// 结束条件：nums 中的元素全都在 track 中出现
    static void backtrack(int[] nums, LinkedList<Integer> track) {
        // 触发结束条件
        if (track.size() == nums.length) {
            res.add(new LinkedList(track));
            return;
        }

        for (int i = 0; i < nums.length; i++) {
            // 排除不合法的选择
            if (track.contains(nums[i]))
                continue;
            // 做选择
            track.add(nums[i]);
            // 进入下一层决策树
            backtrack(nums, track);
            // 取消选择
            track.removeLast();
        }
    }


    // int result = 0;
    // int findTargetSumWays(int[] nums, int target) {
    //     if (nums.length == 0) {
    //         return 0;
    //     }
    //     backtrack(nums, 0, target);
    //     return result;
    // }
    //
    // void backtrack(int[] nums, int i, int rest) {
    //     // base case
    //     if (i == nums.length) {
    //         if (rest == 0) {
    //             // 说明恰好凑出 target
    //             result++;
    //         }
    //         return;
    //     }
    //     // 给 nums[i] 选择 - 号
    //     rest += nums[i];
    //     // 穷举 nums[i + 1]
    //     backtrack(nums, i + 1, rest);
    //     // 撤销选择
    //     rest -= nums[i];
    //
    //     // 给 nums[i] 选择 + 号
    //     rest -= nums[i];
    //     // 穷举 nums[i + 1]
    //     backtrack(nums, i + 1, rest);
    //     // 撤销选择
    //     rest += nums[i];
    // }

    public void main(String[] args) {
        permute(new int[]{1, 2, 3, 4, 5, 6});
        System.out.println(res);
    }

}
