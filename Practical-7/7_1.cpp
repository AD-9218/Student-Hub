#include <iostream>
using namespace std;

int main() {
    int n, q;
    cin >> n >> q;

    int a[n], f = 0, r = -1, c = 0;

    while (q--) {
        string s;
        int x;
        cin >> s;

        if (s == "join") {
            cin >> x;
            if (c == n)
                cout << "Error: Queue Full\n";
            else {
                r = (r + 1) % n;
                a[r] = x;
                c++;
                cout << "Front: " << a[f] << "\n";
            }
        } 
        else if (s == "serve") {
            if (c == 0)
                cout << "Error: Queue Empty\n";
            else {
                f = (f + 1) % n;
                c--;
                if (c == 0) {
                    f = 0;
                    r = -1;
                    cout << "Queue Empty\n";
                } else
                    cout << "Front: " << a[f] << "\n";
            }
        }
    }

    return 0;
}