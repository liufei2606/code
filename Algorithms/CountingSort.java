public class CountingSort {
  public void countingSort(int arr[]) {
    int n = arr.length;
    int output[] = new int[n];

    int count[] = new int[256];
    for (int i = 0; i < 256; i++) {
      count[i] = 0;
    }

    for (int i = 0; i < n; i++) {
      ++count[arr[i]];
    }

    for (int i = 1; i <= 255; i++) {
      count[i] += count[i - 1];
    }

    for (int i = n - 1; i >= 0; i--) {
      output[count[arr[i]] - 1] = arr[i];
      --count[arr[i]];
    }

    for (int i = 0; i < n; i++) {
      arr[i] = output[i];
    }
  }

  public static void main(String args[]) {
    CountingSort os = new CountingSort();
    int arr[] = {1, 4, 1, 2, 5, 2, 4, 1, 8};

    os.countingSort(arr);

    for (int i = 0; i < arr.length; i++) {
      System.out.print(arr[i] + ",");
    }
  }
}