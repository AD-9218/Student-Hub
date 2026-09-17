#include <iostream>
using namespace std;

struct Job {
    int id;
    Job* next;

    Job(int value) {
        id = value;
        next = nullptr;
    }
};

int main() {
    Job* front = nullptr;
    Job* rear = nullptr;
    int q;

    cin >> q;

    while (q--) {
        string op;
        cin >> op;

        if (op == "add") {
            int id;
            cin >> id;

            Job* newJob = new Job(id);

            if (rear == nullptr) {
                front = rear = newJob;
            } else {
                rear->next = newJob;
                rear = newJob;
            }

            cout << "Current Job: " << front->id << endl;
        }
        else if (op == "print") {
            if (front == nullptr) {
                cout << "No Jobs" << endl;
            } else {
                Job* temp = front;
                front = front->next;
                delete temp;

                if (front == nullptr) {
                    rear = nullptr;
                    cout << "No Jobs" << endl;
                } else {
                    cout << "Current Job: " << front->id << endl;
                }
            }
        }
    }

    return 0;
}
