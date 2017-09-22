import {BehaviorSubject} from "rxjs/BehaviorSubject";

export interface AuthGuard {
    userSubject(): BehaviorSubject<Object>;

    user(): Promise<Object>;

    check(): Promise<boolean>;

    login({email, password}): Promise<Object>;

    logout(): Promise<any>;
}
