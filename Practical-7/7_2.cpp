#include <iostream>
using namespace std;

int main() {
    int n = 1000;
    int q[n];
    int f = 0, r = 0;
    int op;

    cin >> op;

    while (op--) {
        string type;
        cin >> type;

        if (type == "arrive") {
            int x;
            cin >> x;

            q[r++] = x;
            cout << "Front: " << q[f] << endl;
        }
        else if (type == "attend") {
            if (f == r) {
                cout << "Queue Underflow" << endl;
            }
            else {
                f++;

                if (f == r)
                    cout << "Queue is Empty" << endl;
                else
                    cout << "Front: " << q[f] << endl;
            }
        }
    }

    return 0;
}