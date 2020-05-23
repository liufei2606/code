#include <iostream>
using namespace std;

class Shape
{
protected:
<<<<<<< Updated upstream
	int width, height;

public:
	Shape(int a = 0, int b = 0)
	{
		width = a;
		height = b;
	}
	virtual int area() = 0;
=======
   int width, height;

public:
   Shape(int a = 0, int b = 0)
   {
      width = a;
      height = b;
   }
   virtual int area() = 0;
>>>>>>> Stashed changes
};
class Rectangle : public Shape
{
public:
<<<<<<< Updated upstream
	Rectangle(int a = 0, int b = 0) : Shape(a, b) {}
	int area()
	{
		cout << "Rectangle class area :" << endl;
		cout << (width * height) << endl;
		return 0;
	}
=======
   Rectangle(int a = 0, int b = 0) : Shape(a, b) {}
   int area()
   {
      cout << "Rectangle class area :" << endl;
      cout << (width * height) << endl;
      return 0;
   }
>>>>>>> Stashed changes
};
class Triangle : public Shape
{
public:
<<<<<<< Updated upstream
	Triangle(int a = 0, int b = 0) : Shape(a, b) {}
	int area()
	{
		cout << "Triangle class area :" << endl;
		cout << (width * height / 2) << endl;
		return 0;
	}
=======
   Triangle(int a = 0, int b = 0) : Shape(a, b) {}
   int area()
   {
      cout << "Triangle class area :" << endl;
      cout << (width * height / 2) << endl;
      return 0;
   }
>>>>>>> Stashed changes
};
// 程序的主函数
int main()
{
<<<<<<< Updated upstream
	Shape *shape;
	Rectangle rec(11, 7);
	Triangle tri(10, 5);
=======
   Shape *shape;
   Rectangle rec(11, 7);
   Triangle tri(10, 5);
>>>>>>> Stashed changes

	// 存储矩形的地址
	shape = &rec;
	// 调用矩形的求面积函数 area
	shape->area();

	// 存储三角形的地址
	shape = &tri;
	// 调用三角形的求面积函数 area
	shape->area();

	return 0;
}
